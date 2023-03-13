<?php

namespace App\Entity;

use App\Repository\PatrimoineCreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatrimoineCreditRepository::class)]
class PatrimoineCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $CodeClient = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $CodeCredit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Libelle1 = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Libelle2 = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Libelle3 = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Libelle4 = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant4 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeClient(): ?string
    {
        return $this->CodeClient;
    }

    public function setCodeClient(?string $CodeClient): self
    {
        $this->CodeClient = $CodeClient;

        return $this;
    }

    public function getCodeCredit(): ?string
    {
        return $this->CodeCredit;
    }

    public function setCodeCredit(?string $CodeCredit): self
    {
        $this->CodeCredit = $CodeCredit;

        return $this;
    }

    public function getLibelle1(): ?string
    {
        return $this->Libelle1;
    }

    public function setLibelle1(?string $Libelle1): self
    {
        $this->Libelle1 = $Libelle1;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(?float $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getLibelle2(): ?string
    {
        return $this->Libelle2;
    }

    public function setLibelle2(?string $Libelle2): self
    {
        $this->Libelle2 = $Libelle2;

        return $this;
    }

    public function getMontant2(): ?float
    {
        return $this->Montant2;
    }

    public function setMontant2(?float $Montant2): self
    {
        $this->Montant2 = $Montant2;

        return $this;
    }

    public function getLibelle3(): ?string
    {
        return $this->Libelle3;
    }

    public function setLibelle3(?string $Libelle3): self
    {
        $this->Libelle3 = $Libelle3;

        return $this;
    }

    public function getMontant3(): ?float
    {
        return $this->Montant3;
    }

    public function setMontant3(?float $Montant3): self
    {
        $this->Montant3 = $Montant3;

        return $this;
    }

    public function getLibelle4(): ?string
    {
        return $this->Libelle4;
    }

    public function setLibelle4(?string $Libelle4): self
    {
        $this->Libelle4 = $Libelle4;

        return $this;
    }

    public function getMontant4(): ?float
    {
        return $this->Montant4;
    }

    public function setMontant4(?float $Montant4): self
    {
        $this->Montant4 = $Montant4;

        return $this;
    }
}
