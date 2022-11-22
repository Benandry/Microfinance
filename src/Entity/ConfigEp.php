<?php

namespace App\Entity;

use App\Repository\ConfigEpRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigEpRepository::class)]
class ConfigEp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $IsNegatif = null;

    #[ORM\Column]
    private ?int $nbrjInactif = null;

    #[ORM\Column]
    private ?int $nbMinRet = null;

    #[ORM\Column]
    private ?int $NbrJrMaxDep = null;

    #[ORM\Column]
    private ?int $ageMinCpt = null;

    #[ORM\Column]
    private ?float $fraisTenuCpt = null;

    #[ORM\Column]
    private ?float $commissionRetCash = null;

    #[ORM\Column]
    private ?float $commissionTransf = null;

    #[ORM\Column]
    private ?float $fraisFermCpt = null;

    #[ORM\Column]
    private ?float $soldeouvert = null;

    #[ORM\ManyToOne(inversedBy: 'ConfigProduit')]
    private ?ProduitEpargne $produitEpargne = null;

    #[ORM\ManyToOne(inversedBy: 'ConfigDevise')]
    private ?Devise $deviseutiliser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsNegatif(): ?bool
    {
        return $this->IsNegatif;
    }

    public function setIsNegatif(bool $IsNegatif): self
    {
        $this->IsNegatif = $IsNegatif;

        return $this;
    }

    public function getNbrjInactif(): ?int
    {
        return $this->nbrjInactif;
    }

    public function setNbrjInactif(int $nbrjInactif): self
    {
        $this->nbrjInactif = $nbrjInactif;

        return $this;
    }

    public function getNbMinRet(): ?int
    {
        return $this->nbMinRet;
    }

    public function setNbMinRet(int $nbMinRet): self
    {
        $this->nbMinRet = $nbMinRet;

        return $this;
    }

    public function getNbrJrMaxDep(): ?int
    {
        return $this->NbrJrMaxDep;
    }

    public function setNbrJrMaxDep(int $NbrJrMaxDep): self
    {
        $this->NbrJrMaxDep = $NbrJrMaxDep;

        return $this;
    }

    public function getAgeMinCpt(): ?int
    {
        return $this->ageMinCpt;
    }

    public function setAgeMinCpt(int $ageMinCpt): self
    {
        $this->ageMinCpt = $ageMinCpt;

        return $this;
    }

    public function getFraisTenuCpt(): ?float
    {
        return $this->fraisTenuCpt;
    }

    public function setFraisTenuCpt(float $fraisTenuCpt): self
    {
        $this->fraisTenuCpt = $fraisTenuCpt;

        return $this;
    }

    public function getCommissionRetCash(): ?float
    {
        return $this->commissionRetCash;
    }

    public function setCommissionRetCash(float $commissionRetCash): self
    {
        $this->commissionRetCash = $commissionRetCash;

        return $this;
    }

    public function getCommissionTransf(): ?float
    {
        return $this->commissionTransf;
    }

    public function setCommissionTransf(float $commissionTransf): self
    {
        $this->commissionTransf = $commissionTransf;

        return $this;
    }

    public function getFraisFermCpt(): ?float
    {
        return $this->fraisFermCpt;
    }

    public function setFraisFermCpt(float $fraisFermCpt): self
    {
        $this->fraisFermCpt = $fraisFermCpt;

        return $this;
    }

    public function getSoldeouvert(): ?float
    {
        return $this->soldeouvert;
    }

    public function setSoldeouvert(float $soldeouvert): self
    {
        $this->soldeouvert = $soldeouvert;

        return $this;
    }

    public function getProduitEpargne(): ?ProduitEpargne
    {
        return $this->produitEpargne;
    }

    public function setProduitEpargne(?ProduitEpargne $produitEpargne): self
    {
        $this->produitEpargne = $produitEpargne;

        return $this;
    }

    public function getDeviseutiliser(): ?Devise
    {
        return $this->deviseutiliser;
    }

    public function setDeviseutiliser(?Devise $deviseutiliser): self
    {
        $this->deviseutiliser = $deviseutiliser;

        return $this;
    }
}
