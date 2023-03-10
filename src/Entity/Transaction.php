<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'planComptable')]
    private ?CompteCaisse $compteCaisse = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(length: 50)]
    private ?string $PieceComptable = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateTransaction = null;

    #[ORM\Column(nullable:true)]
    private ?float $Montant = null;

    #[ORM\Column(length: 100)]
    private ?string $typeClient = null;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $solde = null;

    #[ORM\Column(nullable:true)]
    private ?int $codetransaction = null;

    #[ORM\Column(length: 30,nullable:true)]
    private ?string $codeepargneclient = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getCompteCaisse(): ?CompteCaisse
    {
        return $this->compteCaisse;
    }

    public function setCompteCaisse(?CompteCaisse $compteCaisse): self
    {
        $this->compteCaisse = $compteCaisse;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPieceComptable(): ?string
    {
        return $this->PieceComptable;
    }

    public function setPieceComptable(string $PieceComptable): self
    {
        $this->PieceComptable = $PieceComptable;

        return $this;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->DateTransaction;
    }

    public function setDateTransaction(\DateTimeInterface $DateTransaction): self
    {
        $this->DateTransaction = $DateTransaction;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(float $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }
    
    public function getTypeClient(): ?string
    {
        return $this->typeClient;
    }

    public function setTypeClient(string $typeClient): self
    {
        $this->typeClient = $typeClient;

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

    public function getCodetransaction(): ?int
    {
        return $this->codetransaction;
    }

    public function setCodetransaction(int $codetransaction): self
    {
        $this->codetransaction = $codetransaction;

        return $this;
    }

    public function getCodeepargneclient(): ?string
    {
        return $this->codeepargneclient;
    }

    public function setCodeepargneclient(string $codeepargneclient): self
    {
        $this->codeepargneclient = $codeepargneclient;

        return $this;
    }
}
