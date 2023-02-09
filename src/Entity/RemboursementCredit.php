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
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NumeroCredit = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateRemboursement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PieceCompteble = null;

    #[ORM\Column]
    private ?float $MontantTotalPaye = null;

    #[ORM\Column(nullable: true)]
    private ?float $Papeterie = null;

    #[ORM\Column(nullable: true)]
    private ?bool $TransactionEnLiquide = null;

    #[ORM\Column(nullable: true)]
    private ?bool $TransfertEpargne = null;

    #[ORM\ManyToOne(inversedBy: 'remboursementCredits')]
    private ?PlanComptable $Caisse = null;

    #[ORM\Column]
    private ?int $periode = null;

    #[ORM\Column(nullable: true)]
    private ?float $penalite = null;

    #[ORM\Column(length: 255)]
    private ?string $Commentaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Anticipe = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantEcheance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TypeClient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCredit(): ?string
    {
        return $this->NumeroCredit;
    }

    public function setNumeroCredit(string $NumeroCredit): self
    {
        $this->NumeroCredit = $NumeroCredit;

        return $this;
    }

    public function getDateRemboursement(): ?\DateTimeInterface
    {
        return $this->DateRemboursement;
    }

    public function setDateRemboursement(\DateTimeInterface $DateRemboursement): self
    {
        $this->DateRemboursement = $DateRemboursement;

        return $this;
    }

    public function getPieceCompteble(): ?string
    {
        return $this->PieceCompteble;
    }

    public function setPieceCompteble(?string $PieceCompteble): self
    {
        $this->PieceCompteble = $PieceCompteble;

        return $this;
    }

    public function getMontantTotalPaye(): ?float
    {
        return $this->MontantTotalPaye;
    }

    public function setMontantTotalPaye(float $MontantTotalPaye): self
    {
        $this->MontantTotalPaye = $MontantTotalPaye;

        return $this;
    }

    public function getPapeterie(): ?float
    {
        return $this->Papeterie;
    }

    public function setPapeterie(?float $Papeterie): self
    {
        $this->Papeterie = $Papeterie;

        return $this;
    }

    public function isTransactionEnLiquide(): ?bool
    {
        return $this->TransactionEnLiquide;
    }

    public function setTransactionEnLiquide(?bool $TransactionEnLiquide): self
    {
        $this->TransactionEnLiquide = $TransactionEnLiquide;

        return $this;
    }

    public function isTransfertEpargne(): ?bool
    {
        return $this->TransfertEpargne;
    }

    public function setTransfertEpargne(?bool $TransfertEpargne): self
    {
        $this->TransfertEpargne = $TransfertEpargne;

        return $this;
    }

    public function getCaisse(): ?PlanComptable
    {
        return $this->Caisse;
    }

    public function setCaisse(?PlanComptable $Caisse): self
    {
        $this->Caisse = $Caisse;

        return $this;
    }

    public function getPeriode(): ?int
    {
        return $this->periode;
    }

    public function setPeriode(int $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getPenalite(): ?float
    {
        return $this->penalite;
    }

    public function setPenalite(?float $penalite): self
    {
        $this->penalite = $penalite;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(string $Commentaire): self
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }

    public function __toString()
    {
        return $this->getId();
    }

    public function getAnticipe(): ?string
    {
        return $this->Anticipe;
    }

    public function setAnticipe(?string $Anticipe): self
    {
        $this->Anticipe = $Anticipe;

        return $this;
    }

    public function getMontantEcheance(): ?float
    {
        return $this->MontantEcheance;
    }

    public function setMontantEcheance(?float $MontantEcheance): self
    {
        $this->MontantEcheance = $MontantEcheance;

        return $this;
    }

    public function getTypeClient(): ?string
    {
        return $this->TypeClient;
    }

    public function setTypeClient(?string $TypeClient): self
    {
        $this->TypeClient = $TypeClient;

        return $this;
    }
}
