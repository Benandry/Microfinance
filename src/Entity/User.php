<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

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
    private ?string $sexe = null;

    #[ORM\Column(length: 255)]
    private ?string $responsabilite = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Individuelclient::class)]
    private Collection $individuelclients;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Agence $agence = null;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: DemandeCredit::class)]
    private Collection $demandeCredits;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CompteCaisse::class)]
    private Collection $caisse;

    public function __construct()
    {
        $this->individuelclients = new ArrayCollection();
        $this->demandeCredits = new ArrayCollection();
        $this->caisse = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getResponsabilite(): ?string
    {
        return $this->responsabilite;
    }

    public function setResponsabilite(string $responsabilite): self
    {
        $this->responsabilite = $responsabilite;

        return $this;
    }
    /**
     * @return Collection<int, Individuelclient>
     */
    public function getIndividuelclients(): Collection
    {
        return $this->individuelclients;
    }

    public function addIndividuelclient(Individuelclient $individuelclient): self
    {
        if (!$this->individuelclients->contains($individuelclient)) {
            $this->individuelclients[] = $individuelclient;
            $individuelclient->setUser($this);
        }

        return $this;
    }

    public function removeIndividuelclient(Individuelclient $individuelclient): self
    {
        if ($this->individuelclients->removeElement($individuelclient)) {
            // set the owning side to null (unless already changed)
            if ($individuelclient->getUser() === $this) {
                $individuelclient->setUser(null);
            }
        }

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    /**
     * @return Collection<int, DemandeCredit>
     */
    public function getDemandeCredits(): Collection
    {
        return $this->demandeCredits;
    }

    public function addDemandeCredit(DemandeCredit $demandeCredit): self
    {
        if (!$this->demandeCredits->contains($demandeCredit)) {
            $this->demandeCredits->add($demandeCredit);
            $demandeCredit->setAgent($this);
        }

        return $this;
    }

    public function removeDemandeCredit(DemandeCredit $demandeCredit): self
    {
        if ($this->demandeCredits->removeElement($demandeCredit)) {
            // set the owning side to null (unless already changed)
            if ($demandeCredit->getAgent() === $this) {
                $demandeCredit->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteCaisse>
     */
    public function getCaisse(): Collection
    {
        return $this->caisse;
    }

    public function addCaisse(CompteCaisse $caisse): self
    {
        if (!$this->caisse->contains($caisse)) {
            $this->caisse->add($caisse);
            $caisse->setUser($this);
        }

        return $this;
    }

    public function removeCaisse(CompteCaisse $caisse): self
    {
        if ($this->caisse->removeElement($caisse)) {
            // set the owning side to null (unless already changed)
            if ($caisse->getUser() === $this) {
                $caisse->setUser(null);
            }
        }

        return $this;
    }
}
