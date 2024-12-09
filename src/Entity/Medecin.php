<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'dateDebut', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $idMedecin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\ManyToOne(inversedBy: 'lesMedecins')]
    private ?DomaineMedical $idDomaine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMedecin(): ?Utilisateur
    {
        return $this->idMedecin;
    }

    public function setIdMedecin(Utilisateur $idMedecin): static
    {
        $this->idMedecin = $idMedecin;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getIdDomaine(): ?DomaineMedical
    {
        return $this->idDomaine;
    }

    public function setIdDomaine(?DomaineMedical $idDomaine): static
    {
        $this->idDomaine = $idDomaine;

        return $this;
    }
}
