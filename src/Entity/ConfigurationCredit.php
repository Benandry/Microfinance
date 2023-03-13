<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConfigurationCreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigurationCreditRepository::class)]
#[ApiResource]
class ConfigurationCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMin = null;

    #[ORM\Column(nullable: true)]
    private ?float $InteretNormal = null;

    // #[ORM\Column(nullable: true)]
    // private ?float $InteretDegressif = null;

    // #[ORM\Column(nullable: true)]
    // private ?float $InteretLineaire = null;

    #[ORM\Column(nullable: true)]
    private ?bool $GarantieMoral = null;

    #[ORM\Column(nullable: true)]
    private ?bool $GarantieMaterielle = null;

    #[ORM\Column(nullable: true)]
    private ?float $TauxGarantieMaterielle = null;

    #[ORM\Column(nullable: true)]
    private ?bool $GarantieFinanciere = null;

    #[ORM\Column(nullable: true)]
    private ?float $TauxGarantieFinanciere = null;

    #[ORM\Column(nullable: true)]
    private ?float $FraisDossier = null;

    #[ORM\Column(nullable: true)]
    private ?float $FraisCommission = null;

    #[ORM\Column(nullable: true)]
    private ?float $FraisPapeterie = null;

    #[ORM\Column(nullable: true)]
    private ?float $PenaliteDiminutionIntrt = null;

    #[ORM\Column(nullable: true)]
    private ?float $PenalitePayementAntcp = null;

    #[ORM\Column(nullable: true)]
    private ?float $RetardPourcentage = null;

    #[ORM\Column(nullable: true)]
    private ?float $PayementAnticipe = null;

    #[ORM\Column(nullable: true)]
    private ?float $RetardForfaitaire = null;

    #[ORM\Column(nullable: true)]
    private ?float $RetardPeriode = null;

    #[ORM\Column(nullable: true)]
    private ?bool $RetardPeriodeJour = null;

    #[ORM\Column(nullable: true)]
    private ?bool $RetardPeriodeMois = null;

    // #[ORM\ManyToOne(inversedBy: 'configurationCredits')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?ProduitCredit $ProduitCredit = null;

    #[ORM\Column(length: 255)]
    private ?string $Methode = null;

    #[ORM\Column(nullable: true)]
    private ?float $Tranche = null;

    #[ORM\Column]
    private ?int $idProduit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(?float $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getMontantMin(): ?float
    {
        return $this->MontantMin;
    }

    public function setMontantMin(?float $MontantMin): self
    {
        $this->MontantMin = $MontantMin;

        return $this;
    }

    public function getInteretNormal(): ?float
    {
        return $this->InteretNormal;
    }

    public function setInteretNormal(float $InteretNormal): self
    {
        $this->InteretNormal = $InteretNormal;

        return $this;
    }


    public function isGarantieMoral(): ?bool
    {
        return $this->GarantieMoral;
    }

    public function setGarantieMoral(?bool $GarantieMoral): self
    {
        $this->GarantieMoral = $GarantieMoral;

        return $this;
    }

    public function isGarantieMaterielle(): ?bool
    {
        return $this->GarantieMaterielle;
    }

    public function setGarantieMaterielle(?bool $GarantieMaterielle): self
    {
        $this->GarantieMaterielle = $GarantieMaterielle;

        return $this;
    }

    public function getTauxGarantieMaterielle(): ?float
    {
        return $this->TauxGarantieMaterielle;
    }

    public function setTauxGarantieMaterielle(?float $TauxGarantieMaterielle): self
    {
        $this->TauxGarantieMaterielle = $TauxGarantieMaterielle;

        return $this;
    }

    public function isGarantieFinanciere(): ?bool
    {
        return $this->GarantieFinanciere;
    }

    public function setGarantieFinanciere(?bool $GarantieFinanciere): self
    {
        $this->GarantieFinanciere = $GarantieFinanciere;

        return $this;
    }

    public function getTauxGarantieFinanciere(): ?float
    {
        return $this->TauxGarantieFinanciere;
    }

    public function setTauxGarantieFinanciere(?float $TauxGarantieFinanciere): self
    {
        $this->TauxGarantieFinanciere = $TauxGarantieFinanciere;

        return $this;
    }

    public function getFraisDossier(): ?float
    {
        return $this->FraisDossier;
    }

    public function setFraisDossier(?float $FraisDossier): self
    {
        $this->FraisDossier = $FraisDossier;

        return $this;
    }

    public function getFraisCommission(): ?float
    {
        return $this->FraisCommission;
    }

    public function setFraisCommission(?float $FraisCommission): self
    {
        $this->FraisCommission = $FraisCommission;

        return $this;
    }

    public function getFraisPapeterie(): ?float
    {
        return $this->FraisPapeterie;
    }

    public function setFraisPapeterie(?float $FraisPapeterie): self
    {
        $this->FraisPapeterie = $FraisPapeterie;

        return $this;
    }

    public function getPenaliteDiminutionIntrt(): ?float
    {
        return $this->PenaliteDiminutionIntrt;
    }

    public function setPenaliteDiminutionIntrt(?float $PenaliteDiminutionIntrt): self
    {
        $this->PenaliteDiminutionIntrt = $PenaliteDiminutionIntrt;

        return $this;
    }

    public function getPenalitePayementAntcp(): ?float
    {
        return $this->PenalitePayementAntcp;
    }

    public function setPenalitePayementAntcp(?float $PenalitePayementAntcp): self
    {
        $this->PenalitePayementAntcp = $PenalitePayementAntcp;

        return $this;
    }

    public function getRetardPourcentage(): ?float
    {
        return $this->RetardPourcentage;
    }

    public function setRetardPourcentage(?float $RetardPourcentage): self
    {
        $this->RetardPourcentage = $RetardPourcentage;

        return $this;
    }

    public function getPayementAnticipe(): ?float
    {
        return $this->PayementAnticipe;
    }

    public function setPayementAnticipe(?float $PayementAnticipe): self
    {
        $this->PayementAnticipe = $PayementAnticipe;

        return $this;
    }

    public function getRetardForfaitaire(): ?float
    {
        return $this->RetardForfaitaire;
    }

    public function setRetardForfaitaire(?float $RetardForfaitaire): self
    {
        $this->RetardForfaitaire = $RetardForfaitaire;

        return $this;
    }

    public function getRetardPeriode(): ?float
    {
        return $this->RetardPeriode;
    }

    public function setRetardPeriode(?float $RetardPeriode): self
    {
        $this->RetardPeriode = $RetardPeriode;

        return $this;
    }

    public function isRetardPeriodeJour(): ?bool
    {
        return $this->RetardPeriodeJour;
    }

    public function setRetardPeriodeJour(?bool $RetardPeriodeJour): self
    {
        $this->RetardPeriodeJour = $RetardPeriodeJour;

        return $this;
    }

    public function isRetardPeriodeMois(): ?bool
    {
        return $this->RetardPeriodeMois;
    }

    public function setRetardPeriodeMois(?bool $RetardPeriodeMois): self
    {
        $this->RetardPeriodeMois = $RetardPeriodeMois;

        return $this;
    }

    // public function getProduitCredit(): ?ProduitCredit
    // {
    //     return $this->ProduitCredit;
    // }

    // public function setProduitCredit(?ProduitCredit $ProduitCredit): self
    // {
    //     $this->ProduitCredit = $ProduitCredit;

    //     return $this;
    // }

    public function getMethode(): ?string
    {
        return $this->Methode;
    }

    public function setMethode(string $Methode): self
    {
        $this->Methode = $Methode;

        return $this;
    }

    public function getTranche(): ?float
    {
        return $this->Tranche;
    }

    public function setTranche(?float $Tranche): self
    {
        $this->Tranche = $Tranche;

        return $this;
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function setIdProduit(int $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }
}
