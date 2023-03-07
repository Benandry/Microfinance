<?php

namespace App\Entity;
    
use App\Repository\CompteCaisseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteCaisseRepository::class)]
class CompteCaisse {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCaisse = null;

    #[ORM\ManyToOne(inversedBy: 'agences')]
    private ?Agence $agence = null;

    #[ORM\ManyToOne(inversedBy: 'User')]
    private ?User $responsable = null;

    #[ORM\ManyToOne(inversedBy: 'planComptable')]
    private ?PlanComptable $planComptable = null;

    #[ORM\Column(length: 255)]
    private ?string $codecaisse = null;

    #[ORM\OneToMany(mappedBy: 'caisse', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCaisse(): ?string
    {
        return $this->nomCaisse;
    }

    public function setNomCaisse(string $nomCaisse): self
    {
        $this->nomCaisse = $nomCaisse;

        return $this;
    }

    public function getCodecaisse(): ?string
    {
        return $this->codecaisse;
    }

    public function setCodecaisse(string $codecaisse): self
    {
        $this->codecaisse = $codecaisse;

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

    public function getResponsable(): ?User
    {
        return $this->responsable;
    }

    public function setResponsable(?User $responsable): self
    {
        $this->responsable = $responsable;

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
            $user->setCaisse($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCaisse() === $this) {
                $user->setCaisse(null);
            }
        }

        return $this;
    }
}