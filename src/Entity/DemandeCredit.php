<?php

namespace App\Entity;

use App\Repository\DemandeCreditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeCreditRepository::class)]
class DemandeCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $codeclient = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeClient = null;

    #[ORM\Column(length: 255)]
    private ?string $NumeroCredit = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDemande = null;

    #[ORM\Column]
    private ?float $Montant = null;

    #[ORM\Column]
    private ?float $TauxInteretAnnuel = null;

    #[ORM\Column]
    private ?int $NombreTranche = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeTranche = null;

    #[ORM\Column(length: 255)]
    private ?string $MethodeCalculInteret = null;

    #[ORM\Column]
    private ?int $DiffereDePaiement = null;

    #[ORM\Column]
    private ?float $CapitalDerniereEcheance = null;

    #[ORM\Column(length: 255)]
    private ?string $FondCredit = null;

    // #[ORM\Column]
    // private ?float $MontantEpargneTranche = null;

    // #[ORM\Column]
    // private ?float $MontantFixe = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCredits')]
    private ?ProduitEpargne $ProduitEpargne = null;

    #[ORM\Column(length: 255)]
    private ?string $SoldeEpargne = null;

    #[ORM\Column(length: 255)]
    private ?string $Agent = null;

    // #[ORM\Column(length: 255)]
    // private ?string $ButCredit = null;

    #[ORM\Column(length: 255,nullable : true)]
    private ?string $Categorie1Credit = null;

    #[ORM\Column(length: 255,nullable : true)]
    private ?string $Categorie2Credit = null;

    #[ORM\Column(length: 255,nullable : true)]
    private ?string $Categorie3Credit = null;

    #[ORM\Column(length: 255,nullable : true)]
    private ?string $Categorie4Credit = null;

    #[ORM\Column]
    private ?bool $CalculInteretDiffere = null;

    #[ORM\Column]
    private ?bool $InteretDifferePaiementCapitalise = null;

    #[ORM\Column]
    private ?bool $InteretPayeMemePourDiffere = null;

    #[ORM\Column]
    private ?bool $TrancheDistinctInteretPeriodeDiffere = null;

    #[ORM\Column]
    private ?bool $PaiementPrealableInteret = null;

    #[ORM\Column]
    private ?bool $InteretDeduitDecaissement = null;

    #[ORM\Column]
    private ?bool $CalculInteretJours = null;

    #[ORM\Column]
    private ?bool $ForfaitPaiementPrealableInteret = null;

    #[ORM\Column]
    private ?bool $CreditLieUSD = null;

    #[ORM\Column]
    private ?bool $MettreJourCalendrierNonOuvrable = null;

    #[ORM\Column]
    private ?bool $ReporterPremierTranche = null;

    #[ORM\Column]
    private ?bool $CommissionPourcentageMontantCredit = null;

    #[ORM\Column]
    private ?float $PourcentageCapitalEnCoursInteretCommission = null;

    #[ORM\Column]
    private ?float $MontantFixeParTranche = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCredits')]
    private ?ProduitCredit $ProduitCredit = null;

    #[ORM\Column(length: 255)]
    private ?string $statusApp = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeClient(): ?string
    {
        return $this->TypeClient;
    }

    public function setTypeClient(string $TypeClient): self
    {
        $this->TypeClient = $TypeClient;

        return $this;
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

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->DateDemande;
    }

    public function setDateDemande(\DateTimeInterface $DateDemande): self
    {
        $this->DateDemande = $DateDemande;

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

    public function getTauxInteretAnnuel(): ?float
    {
        return $this->TauxInteretAnnuel;
    }

    public function setTauxInteretAnnuel(float $TauxInteretAnnuel): self
    {
        $this->TauxInteretAnnuel = $TauxInteretAnnuel;

        return $this;
    }

    public function getNombreTranche(): ?int
    {
        return $this->NombreTranche;
    }

    public function setNombreTranche(int $NombreTranche): self
    {
        $this->NombreTranche = $NombreTranche;

        return $this;
    }

    public function getTypeTranche(): ?string
    {
        return $this->TypeTranche;
    }

    public function setTypeTranche(string $TypeTranche): self
    {
        $this->TypeTranche = $TypeTranche;

        return $this;
    }

    public function getMethodeCalculInteret(): ?string
    {
        return $this->MethodeCalculInteret;
    }

    public function setMethodeCalculInteret(string $MethodeCalculInteret): self
    {
        $this->MethodeCalculInteret = $MethodeCalculInteret;

        return $this;
    }

    public function getDiffereDePaiement(): ?int
    {
        return $this->DiffereDePaiement;
    }

    public function setDiffereDePaiement(int $DiffereDePaiement): self
    {
        $this->DiffereDePaiement = $DiffereDePaiement;

        return $this;
    }

    public function getCapitalDerniereEcheance(): ?float
    {
        return $this->CapitalDerniereEcheance;
    }

    public function setCapitalDerniereEcheance(float $CapitalDerniereEcheance): self
    {
        $this->CapitalDerniereEcheance = $CapitalDerniereEcheance;

        return $this;
    }

    public function getFondCredit(): ?string
    {
        return $this->FondCredit;
    }

    public function setFondCredit(string $FondCredit): self
    {
        $this->FondCredit = $FondCredit;

        return $this;
    }

    // public function getMontantEpargneTranche(): ?float
    // {
    //     return $this->MontantEpargneTranche;
    // }

    // public function setMontantEpargneTranche(float $MontantEpargneTranche): self
    // {
    //     $this->MontantEpargneTranche = $MontantEpargneTranche;

    //     return $this;
    // }

    // public function getMontantFixe(): ?float
    // {
    //     return $this->MontantFixe;
    // }

    // public function setMontantFixe(float $MontantFixe): self
    // {
    //     $this->MontantFixe = $MontantFixe;

    //     return $this;
    // }

    public function getProduitEpargne(): ?ProduitEpargne
    {
        return $this->ProduitEpargne;
    }

    public function setProduitEpargne(?ProduitEpargne $ProduitEpargne): self
    {
        $this->ProduitEpargne = $ProduitEpargne;

        return $this;
    }

    public function getSoldeEpargne(): ?string
    {
        return $this->SoldeEpargne;
    }

    public function setSoldeEpargne(string $SoldeEpargne): self
    {
        $this->SoldeEpargne = $SoldeEpargne;

        return $this;
    }

    public function getAgent(): ?string
    {
        return $this->Agent;
    }

    public function setAgent(string $Agent): self
    {
        $this->Agent = $Agent;

        return $this;
    }

    public function getButCredit(): ?string
    {
        return $this->ButCredit;
    }

    public function setButCredit(string $ButCredit): self
    {
        $this->ButCredit = $ButCredit;

        return $this;
    }

    public function getCategorie1Credit(): ?string
    {
        return $this->Categorie1Credit;
    }

    public function setCategorie1Credit(string $Categorie1Credit): self
    {
        $this->Categorie1Credit = $Categorie1Credit;

        return $this;
    }

    public function getCategorie2Credit(): ?string
    {
        return $this->Categorie2Credit;
    }

    public function setCategorie2Credit(string $Categorie2Credit): self
    {
        $this->Categorie2Credit = $Categorie2Credit;

        return $this;
    }

    public function getCategorie3Credit(): ?string
    {
        return $this->Categorie3Credit;
    }

    public function setCategorie3Credit(string $Categorie3Credit): self
    {
        $this->Categorie3Credit = $Categorie3Credit;

        return $this;
    }

    public function getCategorie4Credit(): ?string
    {
        return $this->Categorie4Credit;
    }

    public function setCategorie4Credit(string $Categorie4Credit): self
    {
        $this->Categorie4Credit = $Categorie4Credit;

        return $this;
    }

    public function isCalculInteretDiffere(): ?bool
    {
        return $this->CalculInteretDiffere;
    }

    public function setCalculInteretDiffere(bool $CalculInteretDiffere): self
    {
        $this->CalculInteretDiffere = $CalculInteretDiffere;

        return $this;
    }

    public function isInteretDifferePaiementCapitalise(): ?bool
    {
        return $this->InteretDifferePaiementCapitalise;
    }

    public function setInteretDifferePaiementCapitalise(bool $InteretDifferePaiementCapitalise): self
    {
        $this->InteretDifferePaiementCapitalise = $InteretDifferePaiementCapitalise;

        return $this;
    }

    public function isInteretPayeMemePourDiffere(): ?bool
    {
        return $this->InteretPayeMemePourDiffere;
    }

    public function setInteretPayeMemePourDiffere(bool $InteretPayeMemePourDiffere): self
    {
        $this->InteretPayeMemePourDiffere = $InteretPayeMemePourDiffere;

        return $this;
    }

    public function isTrancheDistinctInteretPeriodeDiffere(): ?bool
    {
        return $this->TrancheDistinctInteretPeriodeDiffere;
    }

    public function setTrancheDistinctInteretPeriodeDiffere(bool $TrancheDistinctInteretPeriodeDiffere): self
    {
        $this->TrancheDistinctInteretPeriodeDiffere = $TrancheDistinctInteretPeriodeDiffere;

        return $this;
    }

    public function isPaiementPrealableInteret(): ?bool
    {
        return $this->PaiementPrealableInteret;
    }

    public function setPaiementPrealableInteret(bool $PaiementPrealableInteret): self
    {
        $this->PaiementPrealableInteret = $PaiementPrealableInteret;

        return $this;
    }

    public function isInteretDeduitDecaissement(): ?bool
    {
        return $this->InteretDeduitDecaissement;
    }

    public function setInteretDeduitDecaissement(bool $InteretDeduitDecaissement): self
    {
        $this->InteretDeduitDecaissement = $InteretDeduitDecaissement;

        return $this;
    }

    public function isCalculInteretJours(): ?bool
    {
        return $this->CalculInteretJours;
    }

    public function setCalculInteretJours(bool $CalculInteretJours): self
    {
        $this->CalculInteretJours = $CalculInteretJours;

        return $this;
    }

    public function isForfaitPaiementPrealableInteret(): ?bool
    {
        return $this->ForfaitPaiementPrealableInteret;
    }

    public function setForfaitPaiementPrealableInteret(bool $ForfaitPaiementPrealableInteret): self
    {
        $this->ForfaitPaiementPrealableInteret = $ForfaitPaiementPrealableInteret;

        return $this;
    }

    public function isCreditLieUSD(): ?bool
    {
        return $this->CreditLieUSD;
    }

    public function setCreditLieUSD(bool $CreditLieUSD): self
    {
        $this->CreditLieUSD = $CreditLieUSD;

        return $this;
    }

    public function isMettreJourCalendrierNonOuvrable(): ?bool
    {
        return $this->MettreJourCalendrierNonOuvrable;
    }

    public function setMettreJourCalendrierNonOuvrable(bool $MettreJourCalendrierNonOuvrable): self
    {
        $this->MettreJourCalendrierNonOuvrable = $MettreJourCalendrierNonOuvrable;

        return $this;
    }

    public function isReporterPremierTranche(): ?bool
    {
        return $this->ReporterPremierTranche;
    }

    public function setReporterPremierTranche(bool $ReporterPremierTranche): self
    {
        $this->ReporterPremierTranche = $ReporterPremierTranche;

        return $this;
    }

    public function isCommissionPourcentageMontantCredit(): ?bool
    {
        return $this->CommissionPourcentageMontantCredit;
    }

    public function setCommissionPourcentageMontantCredit(bool $CommissionPourcentageMontantCredit): self
    {
        $this->CommissionPourcentageMontantCredit = $CommissionPourcentageMontantCredit;

        return $this;
    }

    public function getPourcentageCapitalEnCoursInteretCommission(): ?float
    {
        return $this->PourcentageCapitalEnCoursInteretCommission;
    }

    public function setPourcentageCapitalEnCoursInteretCommission(float $PourcentageCapitalEnCoursInteretCommission): self
    {
        $this->PourcentageCapitalEnCoursInteretCommission = $PourcentageCapitalEnCoursInteretCommission;

        return $this;
    }

    public function getMontantFixeParTranche(): ?float
    {
        return $this->MontantFixeParTranche;
    }

    public function setMontantFixeParTranche(float $MontantFixeParTranche): self
    {
        $this->MontantFixeParTranche = $MontantFixeParTranche;

        return $this;
    }

    public function __toString()
    {
        return $this->getId();
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

    public function getStatusApp(): ?string
    {
        return $this->statusApp;
    }

    public function setStatusApp(string $statusApp): self
    {
        $this->statusApp = $statusApp;

        return $this;
    }
}
