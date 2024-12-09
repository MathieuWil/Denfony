<?php

namespace App\Entity;

use App\Repository\RdvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RdvRepository::class)]
class Rdv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idrdv = null;

    #[ORM\ManyToOne(inversedBy: 'rdvs')]
    private ?patient $idpatient = null;

    #[ORM\ManyToOne(inversedBy: 'rdvs')]
    private ?medecin $idmedecin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $daterdv = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Ordonnance>
     */
    #[ORM\OneToMany(targetEntity: Ordonnance::class, mappedBy: 'idrdv')]
    private Collection $ordonnances;

    public function __construct()
    {
        $this->ordonnances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdrdv(): ?int
    {
        return $this->idrdv;
    }

    public function setIdrdv(int $idrdv): static
    {
        $this->idrdv = $idrdv;

        return $this;
    }

    public function getIdpatient(): ?patient
    {
        return $this->idpatient;
    }

    public function setIdpatient(?patient $idpatient): static
    {
        $this->idpatient = $idpatient;

        return $this;
    }

    public function getIdmedecin(): ?medecin
    {
        return $this->idmedecin;
    }

    public function setIdmedecin(?medecin $idmedecin): static
    {
        $this->idmedecin = $idmedecin;

        return $this;
    }

    public function getDaterdv(): ?\DateTimeInterface
    {
        return $this->daterdv;
    }

    public function setDaterdv(\DateTimeInterface $daterdv): static
    {
        $this->daterdv = $daterdv;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Ordonnance>
     */
    public function getOrdonnances(): Collection
    {
        return $this->ordonnances;
    }

    public function addOrdonnance(Ordonnance $ordonnance): static
    {
        if (!$this->ordonnances->contains($ordonnance)) {
            $this->ordonnances->add($ordonnance);
            $ordonnance->setIdrdv($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): static
    {
        if ($this->ordonnances->removeElement($ordonnance)) {
            // set the owning side to null (unless already changed)
            if ($ordonnance->getIdrdv() === $this) {
                $ordonnance->setIdrdv(null);
            }
        }

        return $this;
    }
}
