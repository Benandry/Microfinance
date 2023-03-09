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

    #[ORM\ManyToOne(inversedBy: 'caisse')]
    private ?User $user = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
