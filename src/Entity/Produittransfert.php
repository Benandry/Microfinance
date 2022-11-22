<?php

namespace App\Entity;

use App\Repository\ProduittransfertRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduittransfertRepository::class)]
class Produittransfert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datetransfert = null;

    #[ORM\ManyToOne(inversedBy: 'comptetransfert1')]
    private ?CompteEpargne $compte1 = null;

    #[ORM\ManyToOne(inversedBy: 'comptetransfert2')]
    private ?CompteEpargne $compte2 = null;

    // #[ORM\ManyToOne(inversedBy: 'produitepargne1')]
    // private ?ProduitEpargne $Produit1 = null;

    // #[ORM\ManyToOne(inversedBy: 'produitepargne2')]
    // private ?ProduitEpargne $ProduitEpargne2 = null;

    #[ORM\Column]
    private ?float $montant = null;

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

    public function getCompte1(): ?CompteEpargne
    {
        return $this->compte1;
    }

    public function setCompte1(?CompteEpargne $compte1): self
    {
        $this->compte1 = $compte1;

        return $this;
    }

    public function getCompte2(): ?CompteEpargne
    {
        return $this->compte2;
    }

    public function setCompte2(?CompteEpargne $compte2): self
    {
        $this->compte2 = $compte2;

        return $this;
    }

    // public function getProduit1(): ?ProduitEpargne
    // {
    //     return $this->Produit1;
    // }

    // public function setProduit1(?ProduitEpargne $Produit1): self
    // {
    //     $this->Produit1 = $Produit1;

    //     return $this;
    // }

    // public function getProduitEpargne2(): ?ProduitEpargne
    // {
    //     return $this->ProduitEpargne2;
    // }

    // public function setProduitEpargne2(?ProduitEpargne $ProduitEpargne2): self
    // {
    //     $this->ProduitEpargne2 = $ProduitEpargne2;

    //     return $this;
    // }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
}
