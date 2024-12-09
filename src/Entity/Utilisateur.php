<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\OneToOne(mappedBy: 'idMedecin', cascade: ['persist', 'remove'])]
    private ?Medecin $medecin = null;

    #[ORM\OneToOne(mappedBy: 'idPatient', cascade: ['persist', 'remove'])]
    private ?Patient $patient = null;

    #[ORM\OneToOne(mappedBy: 'idPatient', cascade: ['persist', 'remove'])]
    private ?Rdv $rdv = null;

    #[ORM\OneToOne(mappedBy: 'idMedecin', cascade: ['persist', 'remove'])]
    private ?Rdv $rdvMedecin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(Medecin $medecin): static
    {
        // set the owning side of the relation if necessary
        if ($medecin->getIdMedecin() !== $this) {
            $medecin->setIdMedecin($this);
        }

        $this->medecin = $medecin;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(Patient $patient): static
    {
        // set the owning side of the relation if necessary
        if ($patient->getIdPatient() !== $this) {
            $patient->setIdPatient($this);
        }

        $this->patient = $patient;

        return $this;
    }

    public function getRdv(): ?Rdv
    {
        return $this->rdv;
    }

    public function setRdv(Rdv $rdv): static
    {
        // set the owning side of the relation if necessary
        if ($rdv->getIdPatient() !== $this) {
            $rdv->setIdPatient($this);
        }

        $this->rdv = $rdv;

        return $this;
    }

    public function getRdvMedecin(): ?Rdv
    {
        return $this->rdvMedecin;
    }

    public function setRdvMedecin(Rdv $rdvMedecin): static
    {
        // set the owning side of the relation if necessary
        if ($rdvMedecin->getIdMedecin() !== $this) {
            $rdvMedecin->setIdMedecin($this);
        }

        $this->rdvMedecin = $rdvMedecin;

        return $this;
    }
}
