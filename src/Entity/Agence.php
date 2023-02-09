<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgenceRepository::class)]
class Agence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomAgence = null;

    #[ORM\Column(length: 255)]
    private ?string $AdressAgence = null;

    #[ORM\OneToMany(mappedBy: 'Agence', targetEntity: Individuelclient::class)]
    private Collection $individuelclients;

    #[ORM\ManyToOne(inversedBy: 'agences')]
    private ?Commune $commune = null;

    #[ORM\Column(length: 255)]
    private ?string $codeAgence = null;

    #[ORM\OneToMany(mappedBy: 'agence', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->individuelclients = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgence(): ?string
    {
        return $this->NomAgence;
    }

    public function setNomAgence(string $NomAgence): self
    {
        $this->NomAgence = $NomAgence;

        return $this;
    }

    public function getAdressAgence(): ?string
    {
        return $this->AdressAgence;
    }

    public function setAdressAgence(string $AdressAgence): self
    {
        $this->AdressAgence = $AdressAgence;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
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
            $individuelclient->setAgence($this);
        }

        return $this;
    }

    public function removeIndividuelclient(Individuelclient $individuelclient): self
    {
        if ($this->individuelclients->removeElement($individuelclient)) {
            // set the owning side to null (unless already changed)
            if ($individuelclient->getAgence() === $this) {
                $individuelclient->setAgence(null);
            }
        }

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCodeAgence(): ?string
    {
        return $this->codeAgence;
    }

    public function setCodeAgence(string $codeAgence): self
    {
        $this->codeAgence = $codeAgence;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setAgence($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAgence() === $this) {
                $user->setAgence(null);
            }
        }

        return $this;
    }
}
