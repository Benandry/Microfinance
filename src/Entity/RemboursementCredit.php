<?php

namespace App\Entity;

use App\Repository\RemboursementCreditRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RemboursementCreditRepository::class)]
class RemboursementCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Tranche = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DatePaiement = null;

    #[ORM\Column(length: 255)]
    private ?string $Principal = null;

    #[ORM\Column]
    private ?float $Interet = null;

    #[ORM\Column]
    private ?float $Commission = null;

    #[ORM\Column]
    private ?float $Penalite = null;

    #[ORM\Column]
    private ?float $Total = null;

    #[ORM\Column]
    private ?float $MontantPaye = null;

    #[ORM\Column]
    private ?float $SoldeRestant = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->DatePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $DatePaiement): self
    {
        $this->DatePaiement = $DatePaiement;

        return $this;
    }

    public function getPrincipal(): ?string
    {
        return $this->Principal;
    }

    public function setPrincipal(string $Principal): self
    {
        $this->Principal = $Principal;

        return $this;
    }

    public function getInteret(): ?float
    {
        return $this->Interet;
    }

    public function setInteret(float $Interet): self
    {
        $this->Interet = $Interet;

        return $this;
    }

    public function getCommission(): ?float
    {
        return $this->Commission;
    }

    public function setCommission(float $Commission): self
    {
        $this->Commission = $Commission;

        return $this;
    }

    public function getPenalite(): ?float
    {
        return $this->Penalite;
    }

    public function setPenalite(float $Penalite): self
    {
        $this->Penalite = $Penalite;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->Total;
    }

    public function setTotal(float $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getMontantPaye(): ?float
    {
        return $this->MontantPaye;
    }

    public function setMontantPaye(float $MontantPaye): self
    {
        $this->MontantPaye = $MontantPaye;

        return $this;
    }

    public function getSoldeRestant(): ?float
    {
        return $this->SoldeRestant;
    }

    public function setSoldeRestant(float $SoldeRestant): self
    {
        $this->SoldeRestant = $SoldeRestant;

        return $this;
    }
}
