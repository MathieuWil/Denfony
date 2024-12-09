<?php

namespace App\Entity;

use App\Repository\OrdonnanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdonnanceRepository::class)]
class Ordonnance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDelivree = null;

    #[ORM\Column(length: 255)]
    private ?string $medicament = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'ordonnances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rdv $idRdv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDelivree(): ?\DateTimeInterface
    {
        return $this->dateDelivree;
    }

    public function setDateDelivree(\DateTimeInterface $dateDelivree): static
    {
        $this->dateDelivree = $dateDelivree;

        return $this;
    }

    public function getMedicament(): ?string
    {
        return $this->medicament;
    }

    public function setMedicament(string $medicament): static
    {
        $this->medicament = $medicament;

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

    public function getIdRdv(): ?Rdv
    {
        return $this->idRdv;
    }

    public function setIdRdv(?Rdv $idRdv): static
    {
        $this->idRdv = $idRdv;

        return $this;
    }
}
