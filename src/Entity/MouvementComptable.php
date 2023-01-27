<?php

namespace App\Entity;

use App\Repository\MouvementComptableRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MouvementComptableRepository::class)]
class MouvementComptable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateMouvement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $debit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $credit = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $solde = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $refTransaction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pieceComptable = null;

    #[ORM\ManyToOne(inversedBy: 'mouvementComptables')]
    private ?PlanComptable $planCompta = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $codeclient = null;


    public function __toString()
    {
        return $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMouvement(): ?\DateTimeInterface
    {
        return $this->dateMouvement;
    }

    public function setDateMouvement(\DateTimeInterface $dateMouvement): self
    {
        $this->dateMouvement = $dateMouvement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDebit(): ?string
    {
        return $this->debit;
    }

    public function setDebit(?string $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getCredit(): ?string
    {
        return $this->credit;
    }

    public function setCredit(?string $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getRefTransaction(): ?string
    {
        return $this->refTransaction;
    }

    public function setRefTransaction(?string $refTransaction): self
    {
        $this->refTransaction = $refTransaction;

        return $this;
    }

    public function getPieceComptable(): ?string
    {
        return $this->pieceComptable;
    }

    public function setPieceComptable(?string $pieceComptable): self
    {
        $this->pieceComptable = $pieceComptable;

        return $this;
    }

    public function getPlanCompta(): ?PlanComptable
    {
        return $this->planCompta;
    }

    public function setPlanCompta(?PlanComptable $planCompta): self
    {
        $this->planCompta = $planCompta;

        return $this;
    }

    public function getCodeclient(): ?string
    {
        return $this->codeclient;
    }

    public function setCodeclient(string $codeclient): self
    {
        $this->codeclient = $codeclient;

        return $this;
    }
}
