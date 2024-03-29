<?php

namespace App\Entity;

use App\Repository\FicheDeCreditRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheDeCreditRepository::class)]
class FicheDeCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateTransaction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Transaction = null;

    
    #[ORM\Column(nullable: true)]
    private ?float $CapitalDu = null;

    #[ORM\Column(nullable: true)]
    private ?float $InteretDu = null;

    #[ORM\Column(nullable: true)]
    private ?float $CreditDu = null;

    #[ORM\Column(nullable: true)]
    private ?float $Capital = null;

    #[ORM\Column(nullable: true)]
    private ?float $Interet = null;

    #[ORM\Column(nullable: true)]
    private ?float $Total = null;

    #[ORM\Column(nullable: true)]
    private ?float $SoldeCourant = null;

    // #[ORM\Column(nullable: true)]
    // private ?float $InteretRD = null;


    #[ORM\Column(nullable: true)]
    private ?float $Penalite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NumeroCredit = null;

    #[ORM\Column(nullable: true)]
    private ?int $Periode = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->DateTransaction;
    }

    public function setDateTransaction(?\DateTimeInterface $DateTransaction): self
    {
        $this->DateTransaction = $DateTransaction;

        return $this;
    }

    public function getTransaction(): ?string
    {
        return $this->Transaction;
    }

    public function setTransaction(?string $Transaction): self
    {
        $this->Transaction = $Transaction;

        return $this;
    }

    public function getCapitalDu(): ?float
    {
        return $this->CapitalDu;
    }

    public function setCapitalDu(?float $CapitalDu): self
    {
        $this->CapitalDu = $CapitalDu;

        return $this;
    }

    public function getInteretDu(): ?float
    {
        return $this->InteretDu;
    }

    public function setInteretDu(?float $InteretDu): self
    {
        $this->InteretDu = $InteretDu;

        return $this;
    }

    public function getCreditDu(): ?float
    {
        return $this->CreditDu;
    }

    public function setCreditDu(?float $CreditDu): self
    {
        $this->CreditDu = $CreditDu;

        return $this;
    }


    public function getCapital(): ?float
    {
        return $this->Capital;
    }

    public function setCapital(?float $Capital): self
    {
        $this->Capital = $Capital;

        return $this;
    }

    public function getInteret(): ?float
    {
        return $this->Interet;
    }

    public function setInteret(?float $Interet): self
    {
        $this->Interet = $Interet;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->Total;
    }

    public function setTotal(?float $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getPenalite(): ?float
    {
        return $this->Penalite;
    }

    public function setPenalite(?float $Penalite): self
    {
        $this->Penalite = $Penalite;

        return $this;
    }

    public function getNumeroCredit(): ?string
    {
        return $this->NumeroCredit;
    }

    public function setNumeroCredit(?string $NumeroCredit): self
    {
        $this->NumeroCredit = $NumeroCredit;

        return $this;
    }

    public function getPeriode(): ?int
    {
        return $this->Periode;
    }

    public function setPeriode(?int $Periode): self
    {
        $this->Periode = $Periode;

        return $this;
    }

    public function getSoldeCourant(): ?float
    {
        return $this->SoldeCourant;
    }

    public function setSoldeCourant(?float $SoldeCourant): self
    {
        $this->SoldeCourant = $SoldeCourant;

        return $this;
    }

    // public function getInteretRD(): ?float
    // {
    //     return $this->InteretRD;
    // }

    // public function setInteretRD(?float $InteretRD): self
    // {
    //     $this->InteretRD = $InteretRD;

    //     return $this;
    // }

}
