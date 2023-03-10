<?php

namespace App\Entity;

use App\Repository\CompteCaisseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteCaisseRepository::class)]
class CompteCaisse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomCaisse = null;

    #[ORM\Column(length: 255)]
    private ?string $codeCaisse = null;

    #[ORM\ManyToOne(inversedBy: 'compteCaisses')]
    private ?PlanComptable $planComptable = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'caisse')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCaisse(): ?string
    {
        return $this->nomCaisse;
    }

    public function setNomCaisse(?string $nomCaisse): self
    {
        $this->nomCaisse = $nomCaisse;

        return $this;
    }

    public function getCodeCaisse(): ?string
    {
        return $this->codeCaisse;
    }

    public function setCodeCaisse(string $codeCaisse): self
    {
        $this->codeCaisse = $codeCaisse;

        return $this;
    }

    public function getPlanComptable(): ?PlanComptable
    {
        return $this->planComptable;
    }

    public function setPlanComptable(?PlanComptable $planComptable): self
    {
        $this->planComptable = $planComptable;

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
            $user->addCaisse($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeCaisse($this);
        }

        return $this;
    }
}
