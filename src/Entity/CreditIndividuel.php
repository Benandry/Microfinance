<?php

namespace App\Entity;

use App\Repository\CreditIndividuelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreditIndividuelRepository::class)]
class CreditIndividuel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $TauxInteretAnnuel = null;

    #[ORM\Column]
    private ?float $DifferementPayement = null;

    #[ORM\Column]
    private ?int $Tranche = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeTranche = null;

    #[ORM\Column(length: 255)]
    private ?string $CalculInteret = null;

    #[ORM\Column]
    private ?float $MontantMinimumCredit = null;

    #[ORM\Column]
    private ?float $MontantMaximumCredit = null;

    #[ORM\Column]
    private ?int $DelaisDeGraceMaxi = null;

    #[ORM\Column]
    private ?bool $PaiementPrealableInteret = null;

    #[ORM\Column]
    private ?bool $CalculIntertPourDiffere = null;

    #[ORM\Column]
    private ?bool $IntaretDifferePaiementCapitalise = null;

    #[ORM\Column]
    private ?bool $InteretPayerDiffere = null;

    #[ORM\Column]
    private ?bool $TrancheDistinctInteret = null;

    #[ORM\Column]
    private ?bool $InteretDeductDecaissement = null;

    #[ORM\Column]
    private ?bool $CalculInteretJours = null;

    #[ORM\Column]
    private ?bool $ForfaitPaiementPrealableInteret = null;

    #[ORM\Column]
    private ?int $PeriodeMinimumCredit = null;

    #[ORM\Column]
    private ?int $PeriodeMaximumCredit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTauxInteretAnnuel(): ?float
    {
        return $this->TauxInteretAnnuel;
    }

    public function setTauxInteretAnnuel(float $TauxInteretAnnuel): self
    {
        $this->TauxInteretAnnuel = $TauxInteretAnnuel;

        return $this;
    }

    public function getDifferementPayement(): ?float
    {
        return $this->DifferementPayement;
    }

    public function setDifferementPayement(float $DifferementPayement): self
    {
        $this->DifferementPayement = $DifferementPayement;

        return $this;
    }

    public function getTranche(): ?int
    {
        return $this->Tranche;
    }

    public function setTranche(int $Tranche): self
    {
        $this->Tranche = $Tranche;

        return $this;
    }

    public function getTypeTranche(): ?string
    {
        return $this->TypeTranche;
    }

    public function setTypeTranche(string $TypeTranche): self
    {
        $this->TypeTranche = $TypeTranche;

        return $this;
    }

    public function getCalculInteret(): ?string
    {
        return $this->CalculInteret;
    }

    public function setCalculInteret(string $CalculInteret): self
    {
        $this->CalculInteret = $CalculInteret;

        return $this;
    }

    public function getMontantMinimumCredit(): ?float
    {
        return $this->MontantMinimumCredit;
    }

    public function setMontantMinimumCredit(float $MontantMinimumCredit): self
    {
        $this->MontantMinimumCredit = $MontantMinimumCredit;

        return $this;
    }

    public function getMontantMaximumCredit(): ?float
    {
        return $this->MontantMaximumCredit;
    }

    public function setMontantMaximumCredit(float $MontantMaximumCredit): self
    {
        $this->MontantMaximumCredit = $MontantMaximumCredit;

        return $this;
    }

    public function getDelaisDeGraceMaxi(): ?int
    {
        return $this->DelaisDeGraceMaxi;
    }

    public function setDelaisDeGraceMaxi(int $DelaisDeGraceMaxi): self
    {
        $this->DelaisDeGraceMaxi = $DelaisDeGraceMaxi;

        return $this;
    }

    public function isPaiementPrealableInteret(): ?bool
    {
        return $this->PaiementPrealableInteret;
    }

    public function setPaiementPrealableInteret(bool $PaiementPrealableInteret): self
    {
        $this->PaiementPrealableInteret = $PaiementPrealableInteret;

        return $this;
    }

    public function isCalculIntertPourDiffere(): ?bool
    {
        return $this->CalculIntertPourDiffere;
    }

    public function setCalculIntertPourDiffere(bool $CalculIntertPourDiffere): self
    {
        $this->CalculIntertPourDiffere = $CalculIntertPourDiffere;

        return $this;
    }

    public function isIntaretDifferePaiementCapitalise(): ?bool
    {
        return $this->IntaretDifferePaiementCapitalise;
    }

    public function setIntaretDifferePaiementCapitalise(bool $IntaretDifferePaiementCapitalise): self
    {
        $this->IntaretDifferePaiementCapitalise = $IntaretDifferePaiementCapitalise;

        return $this;
    }

    public function isInteretPayerDiffere(): ?bool
    {
        return $this->InteretPayerDiffere;
    }

    public function setInteretPayerDiffere(bool $InteretPayerDiffere): self
    {
        $this->InteretPayerDiffere = $InteretPayerDiffere;

        return $this;
    }

    public function isTrancheDistinctInteret(): ?bool
    {
        return $this->TrancheDistinctInteret;
    }

    public function setTrancheDistinctInteret(bool $TrancheDistinctInteret): self
    {
        $this->TrancheDistinctInteret = $TrancheDistinctInteret;

        return $this;
    }

    public function isInteretDeductDecaissement(): ?bool
    {
        return $this->InteretDeductDecaissement;
    }

    public function setInteretDeductDecaissement(bool $InteretDeductDecaissement): self
    {
        $this->InteretDeductDecaissement = $InteretDeductDecaissement;

        return $this;
    }

    public function isCalculInteretJours(): ?bool
    {
        return $this->CalculInteretJours;
    }

    public function setCalculInteretJours(bool $CalculInteretJours): self
    {
        $this->CalculInteretJours = $CalculInteretJours;

        return $this;
    }

    public function isForfaitPaiementPrealableInteret(): ?bool
    {
        return $this->ForfaitPaiementPrealableInteret;
    }

    public function setForfaitPaiementPrealableInteret(bool $ForfaitPaiementPrealableInteret): self
    {
        $this->ForfaitPaiementPrealableInteret = $ForfaitPaiementPrealableInteret;

        return $this;
    }

    public function getPeriodeMinimumCredit(): ?int
    {
        return $this->PeriodeMinimumCredit;
    }

    public function setPeriodeMinimumCredit(int $PeriodeMinimumCredit): self
    {
        $this->PeriodeMinimumCredit = $PeriodeMinimumCredit;

        return $this;
    }

    public function getPeriodeMaximumCredit(): ?int
    {
        return $this->PeriodeMaximumCredit;
    }

    public function setPeriodeMaximumCredit(int $PeriodeMaximumCredit): self
    {
        $this->PeriodeMaximumCredit = $PeriodeMaximumCredit;

        return $this;
    }
}
