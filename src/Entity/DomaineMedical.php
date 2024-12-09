<?php

namespace App\Entity;

use App\Repository\DomaineMedicalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DomaineMedicalRepository::class)]
class DomaineMedical
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $iddomaine = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, Medecin>
     */
    #[ORM\OneToMany(targetEntity: Medecin::class, mappedBy: 'idDomaine')]
    private Collection $lesMedecins;

    /**
     * @var Collection<int, Rdv>
     */
    #[ORM\OneToMany(targetEntity: Rdv::class, mappedBy: 'idDomaineMedical')]
    private Collection $rdvs;

    public function __construct()
    {
        $this->lesMedecins = new ArrayCollection();
        $this->rdvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIddomaine(): ?int
    {
        return $this->iddomaine;
    }

    public function setIddomaine(int $iddomaine): static
    {
        $this->iddomaine = $iddomaine;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Medecin>
     */
    public function getLesMedecins(): Collection
    {
        return $this->lesMedecins;
    }

    public function addLesMedecin(Medecin $lesMedecin): static
    {
        if (!$this->lesMedecins->contains($lesMedecin)) {
            $this->lesMedecins->add($lesMedecin);
            $lesMedecin->setIdDomaine($this);
        }

        return $this;
    }

    public function removeLesMedecin(Medecin $lesMedecin): static
    {
        if ($this->lesMedecins->removeElement($lesMedecin)) {
            // set the owning side to null (unless already changed)
            if ($lesMedecin->getIdDomaine() === $this) {
                $lesMedecin->setIdDomaine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rdv>
     */
    public function getRdvs(): Collection
    {
        return $this->rdvs;
    }

    public function addRdv(Rdv $rdv): static
    {
        if (!$this->rdvs->contains($rdv)) {
            $this->rdvs->add($rdv);
            $rdv->setIdDomaineMedical($this);
        }

        return $this;
    }

    public function removeRdv(Rdv $rdv): static
    {
        if ($this->rdvs->removeElement($rdv)) {
            // set the owning side to null (unless already changed)
            if ($rdv->getIdDomaineMedical() === $this) {
                $rdv->setIdDomaineMedical(null);
            }
        }

        return $this;
    }
}
