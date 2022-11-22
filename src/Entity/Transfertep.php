<?php

namespace App\Entity;

use App\Repository\TransfertepRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransfertepRepository::class)]
class Transfertep
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $description_t = null;

    #[ORM\Column(length: 30)]
    private ?string $piece_comptable_t = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_transaction_t = null;

    #[ORM\Column]
    private ?int $montantdestinataire = null;

    #[ORM\Column]
    private ?int $papeterie = null;

    #[ORM\Column]
    private ?int $commission = null;

    #[ORM\Column(length: 100)]
    private ?string $type_client_t = null;

    #[ORM\Column(nullable:true)]
    private ?string $soldedestinataire = null;

    #[ORM\Column]
    private ?int $soldeenvoyeur = null;

    #[ORM\Column(length: 255)]
    private ?string $codetransaction_t = null;

    #[ORM\Column(length: 20)]
    private ?string $codedestinateur = null;

    #[ORM\Column(length: 20)]
    private ?string $codeenvoyeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionT(): ?string
    {
        return $this->description_t;
    }

    public function setDescriptionT(string $description_t): self
    {
        $this->description_t = $description_t;

        return $this;
    }

    public function getPieceComptableT(): ?string
    {
        return $this->piece_comptable_t;
    }

    public function setPieceComptableT(string $piece_comptable_t): self
    {
        $this->piece_comptable_t = $piece_comptable_t;

        return $this;
    }

    public function getDateTransactionT(): ?\DateTimeInterface
    {
        return $this->date_transaction_t;
    }

    public function setDateTransactionT(\DateTimeInterface $date_transaction_t): self
    {
        $this->date_transaction_t = $date_transaction_t;

        return $this;
    }

    public function getMontantdestinataire(): ?int
    {
        return $this->montantdestinataire;
    }

    public function setMontantdestinataire(int $montantdestinataire): self
    {
        $this->montantdestinataire = $montantdestinataire;

        return $this;
    }

    public function getPapeterie(): ?int
    {
        return $this->papeterie;
    }

    public function setPapeterie(int $papeterie): self
    {
        $this->papeterie = $papeterie;

        return $this;
    }

    public function getCommission(): ?int
    {
        return $this->commission;
    }

    public function setCommission(int $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    public function getTypeClientT(): ?string
    {
        return $this->type_client_t;
    }

    public function setTypeClientT(string $type_client_t): self
    {
        $this->type_client_t = $type_client_t;

        return $this;
    }

    public function getSoldedestinataire(): ?string
    {
        return $this->soldedestinataire;
    }

    public function setSoldedestinataire(string $soldedestinataire): self
    {
        $this->soldedestinataire = $soldedestinataire;

        return $this;
    }

    public function getSoldeenvoyeur(): ?int
    {
        return $this->soldeenvoyeur;
    }

    public function setSoldeenvoyeur(int $soldeenvoyeur): self
    {
        $this->soldeenvoyeur = $soldeenvoyeur;

        return $this;
    }

    public function getCodetransactionT(): ?string
    {
        return $this->codetransaction_t;
    }

    public function setCodetransactionT(string $codetransaction_t): self
    {
        $this->codetransaction_t = $codetransaction_t;

        return $this;
    }

    public function getCodedestinateur(): ?string
    {
        return $this->codedestinateur;
    }

    public function setCodedestinateur(string $codedestinateur): self
    {
        $this->codedestinateur = $codedestinateur;

        return $this;
    }

    public function getCodeenvoyeur(): ?string
    {
        return $this->codeenvoyeur;
    }

    public function setCodeenvoyeur(string $codeenvoyeur): self
    {
        $this->codeenvoyeur = $codeenvoyeur;

        return $this;
    }
}