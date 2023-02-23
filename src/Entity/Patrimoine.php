<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PatrimoineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatrimoineRepository::class)]
#[ApiResource]
class Patrimoine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $IdClient = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Libelle1 = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Libelle2 = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Montant3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Libelle3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Libelle4 = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant4 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateenregistrement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?int
    {
        return $this->IdClient;
    }

    public function setIdClient(?int $IdClient): self
    {
        $this->IdClient = $IdClient;

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

    public function getMontant1(): ?float
    {
        return $this->Montant1;
    }

    public function setMontant1(?float $Montant1): self
    {
        $this->Montant1 = $Montant1;

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

    public function getMontant3(): ?string
    {
        return $this->Montant3;
    }

    public function setMontant3(?string $Montant3): self
    {
        $this->Montant3 = $Montant3;

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

    public function getDateenregistrement(): ?\DateTimeInterface
    {
        return $this->dateenregistrement;
    }

    public function setDateenregistrement(?\DateTimeInterface $dateenregistrement): self
    {
        $this->dateenregistrement = $dateenregistrement;

        return $this;
    }
}
