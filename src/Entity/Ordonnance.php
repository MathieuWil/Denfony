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

    #[ORM\ManyToOne(inversedBy: 'ordonnances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rdv $id_rdv = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_delivree = null;

    #[ORM\Column(length: 255)]
    private ?string $medicament = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRdv(): ?Rdv
    {
        return $this->id_rdv;
    }

    public function setIdRdv(?Rdv $id_rdv): static
    {
        $this->id_rdv = $id_rdv;

        return $this;
    }

    public function getDateDelivree(): ?\DateTimeInterface
    {
        return $this->date_delivree;
    }

    public function setDateDelivree(\DateTimeInterface $date_delivree): static
    {
        $this->date_delivree = $date_delivree;

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
}
