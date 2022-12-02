<?php

namespace App\Entity;

use App\Repository\FraisConfigCreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FraisConfigCreditRepository::class)]
class FraisConfigCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fraisConfigCredits')]
    private ?ProduitCredit $ProduitCredit = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeClient = null;

    #[ORM\Column]
    private ?float $Papeterie = null;

    #[ORM\Column]
    private ?float $Commission = null;

    #[ORM\Column]
    private ?float $FraisDeDeveloppement = null;

    #[ORM\Column]
    private ?float $FraisDeRefinancement = null;

    #[ORM\Column]
    private ?float $CommissionCreditChaqueTrancheInd = null;

    #[ORM\Column]
    private ?float $DroitTimbreSurCapital = null;

    #[ORM\Column]
    private ?float $SurInteretCours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduitCredit(): ?ProduitCredit
    {
        return $this->ProduitCredit;
    }

    public function setProduitCredit(?ProduitCredit $ProduitCredit): self
    {
        $this->ProduitCredit = $ProduitCredit;

        return $this;
    }

    public function getTypeClient(): ?string
    {
        return $this->TypeClient;
    }

    public function setTypeClient(string $TypeClient): self
    {
        $this->TypeClient = $TypeClient;

        return $this;
    }

    public function getPapeterie(): ?float
    {
        return $this->Papeterie;
    }

    public function setPapeterie(float $Papeterie): self
    {
        $this->Papeterie = $Papeterie;

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

    public function getFraisDeDeveloppement(): ?float
    {
        return $this->FraisDeDeveloppement;
    }

    public function setFraisDeDeveloppement(float $FraisDeDeveloppement): self
    {
        $this->FraisDeDeveloppement = $FraisDeDeveloppement;

        return $this;
    }

    public function getFraisDeRefinancement(): ?float
    {
        return $this->FraisDeRefinancement;
    }

    public function setFraisDeRefinancement(float $FraisDeRefinancement): self
    {
        $this->FraisDeRefinancement = $FraisDeRefinancement;

        return $this;
    }

    public function getCommissionCreditChaqueTrancheInd(): ?float
    {
        return $this->CommissionCreditChaqueTrancheInd;
    }

    public function setCommissionCreditChaqueTrancheInd(float $CommissionCreditChaqueTrancheInd): self
    {
        $this->CommissionCreditChaqueTrancheInd = $CommissionCreditChaqueTrancheInd;

        return $this;
    }

    public function getDroitTimbreSurCapital(): ?float
    {
        return $this->DroitTimbreSurCapital;
    }

    public function setDroitTimbreSurCapital(float $DroitTimbreSurCapital): self
    {
        $this->DroitTimbreSurCapital = $DroitTimbreSurCapital;

        return $this;
    }

    public function getSurInteretCours(): ?float
    {
        return $this->SurInteretCours;
    }

    public function setSurInteretCours(float $SurInteretCours): self
    {
        $this->SurInteretCours = $SurInteretCours;

        return $this;
    }
}
