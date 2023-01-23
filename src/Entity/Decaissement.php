<?php

namespace App\Entity;

use App\Repository\DecaissementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DecaissementRepository::class)]
class Decaissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroCredit = null;

    #[ORM\Column]
    private ?float $montantCredit = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDecaissement = null;

    #[ORM\Column(length: 255)]
    private ?string $pieceComptable = null;

    #[ORM\Column]
    private ?float $fraisPapeterie = null;

    #[ORM\Column]
    private ?float $commissionCredit = null;

    #[ORM\Column]
    private ?float $fraisDeDeveloppement = null;

    #[ORM\Column]
    private ?float $caisseCredit = null;

    #[ORM\Column]
    private ?bool $cash = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $refDecaissement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCredit(): ?string
    {
        return $this->numeroCredit;
    }

    public function setNumeroCredit(string $numeroCredit): self
    {
        $this->numeroCredit = $numeroCredit;

        return $this;
    }

    public function getMontantCredit(): ?float
    {
        return $this->montantCredit;
    }

    public function setMontantCredit(float $montantCredit): self
    {
        $this->montantCredit = $montantCredit;

        return $this;
    }

    public function getDateDecaissement(): ?\DateTimeInterface
    {
        return $this->dateDecaissement;
    }

    public function setDateDecaissement(\DateTimeInterface $dateDecaissement): self
    {
        $this->dateDecaissement = $dateDecaissement;

        return $this;
    }

    public function getPieceComptable(): ?string
    {
        return $this->pieceComptable;
    }

    public function setPieceComptable(string $pieceComptable): self
    {
        $this->pieceComptable = $pieceComptable;

        return $this;
    }

    public function getFraisPapeterie(): ?float
    {
        return $this->fraisPapeterie;
    }

    public function setFraisPapeterie(float $fraisPapeterie): self
    {
        $this->fraisPapeterie = $fraisPapeterie;

        return $this;
    }

    public function getCommissionCredit(): ?float
    {
        return $this->commissionCredit;
    }

    public function setCommissionCredit(float $commissionCredit): self
    {
        $this->commissionCredit = $commissionCredit;

        return $this;
    }

    public function getFraisDeDeveloppement(): ?float
    {
        return $this->fraisDeDeveloppement;
    }

    public function setFraisDeDeveloppement(float $fraisDeDeveloppement): self
    {
        $this->fraisDeDeveloppement = $fraisDeDeveloppement;

        return $this;
    }

    public function getCaisseCredit(): ?float
    {
        return $this->caisseCredit;
    }

    public function setCaisseCredit(float $caisseCredit): self
    {
        $this->caisseCredit = $caisseCredit;

        return $this;
    }

    public function isCash(): ?bool
    {
        return $this->cash;
    }

    public function setCash(bool $cash): self
    {
        $this->cash = $cash;

        return $this;
    }

    public function getRefDecaissement(): ?string
    {
        return $this->refDecaissement;
    }

    public function setRefDecaissement(?string $refDecaissement): self
    {
        $this->refDecaissement = $refDecaissement;

        return $this;
    }
}
