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
    private ?int $nbMinRet = null;

    #[ORM\Column]
    private ?int $NbrJrMaxDep = null;

    #[ORM\Column]
    private ?int $ageMinCpt = null;

    #[ORM\Column]
    private ?float $soldeouvert = null;

    #[ORM\ManyToOne(inversedBy: 'ConfigProduit')]
    private ?ProduitEpargne $produitEpargne = null;

    #[ORM\ManyToOne(inversedBy: 'ConfigDevise')]
    private ?Devise $deviseutiliser = null;

    #[ORM\Column(nullable: true)]
    private ?bool $statusProduit = null;

    #[ORM\ManyToOne(inversedBy: 'configEps')]
    private ?PlanComptable $compteProduit = null;

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

    public function isStatusProduit(): ?bool
    {
        return $this->statusProduit;
    }

    public function setStatusProduit(?bool $statusProduit): self
    {
        $this->statusProduit = $statusProduit;

        return $this;
    }

    public function getCompteProduit(): ?PlanComptable
    {
        return $this->compteProduit;
    }

    public function setCompteProduit(?PlanComptable $compteProduit): self
    {
        $this->compteProduit = $compteProduit;

        return $this;
    }
}
