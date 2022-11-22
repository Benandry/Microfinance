<?php

namespace App\Entity;

use App\Repository\TransfertProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransfertProduitRepository::class)]
class TransfertProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datetransfert = null;

    #[ORM\ManyToOne(inversedBy: 'transfertProduits')]
    private ?CompteEpargne $produitatransferer = null;

    #[ORM\ManyToOne(inversedBy: 'produittransmis')]
    private ?CompteEpargne $Produittransmis = null;

    #[ORM\ManyToOne(inversedBy: 'compteTransfert')]
    private ?CompteEpargne $compte = null;

    #[ORM\Column]
    private ?float $Montant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetransfert(): ?\DateTimeInterface
    {
        return $this->datetransfert;
    }

    public function setDatetransfert(\DateTimeInterface $datetransfert): self
    {
        $this->datetransfert = $datetransfert;

        return $this;
    }

    public function getProduitatransferer(): ?CompteEpargne
    {
        return $this->produitatransferer;
    }

    public function setProduitatransferer(?CompteEpargne $produitatransferer): self
    {
        $this->produitatransferer = $produitatransferer;

        return $this;
    }

    public function getProduittransmis(): ?CompteEpargne
    {
        return $this->Produittransmis;
    }

    public function setProduittransmis(?CompteEpargne $Produittransmis): self
    {
        $this->Produittransmis = $Produittransmis;

        return $this;
    }

    public function getCompte(): ?CompteEpargne
    {
        return $this->compte;
    }

    public function setCompte(?CompteEpargne $compte): self
    {
        $this->compte = $compte;

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
}
