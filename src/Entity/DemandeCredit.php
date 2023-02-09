<?php

namespace App\Entity;

use App\Repository\DemandeCreditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\NullableType;

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

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $SoldeEpargne = null;

    #[ORM\Column(nullable:true)]
    private ?bool $CalculInteretDiffere = null;

    #[ORM\Column(nullable:true)]
    private ?bool $CalculInteretJours = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCredits')]
    private ?ProduitCredit $ProduitCredit = null;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $statusApp = null;


    #[ORM\ManyToOne(inversedBy: 'demandeCredits')]
    #[ORM\Column(nullable:true)]
    private ?FondCredit $FondCredit = null;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $typeAmortissement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $garant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $garantie = null;

    #[ORM\Column(nullable: true)]
    private ?int $Valeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ValeurUnitaure = null;

    #[ORM\Column(nullable: true)]
    private ?int $Unite = null;

    #[ORM\Column(nullable: true)]
    private ?int $ValeurTotal = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCredits')]
    private ?User $agent = null;

    #[ORM\Column(nullable: true)]
    private ?int $cycles = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCredits')]
    private ?CategorieCredit $categorieCredit = null;

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

<<<<<<< HEAD
=======
    // public function getFondCredit(): ?string
    // {
    //     return $this->FondCredit;
    // }

    // public function setFondCredit(string $FondCredit): self
    // {
    //     $this->FondCredit = $FondCredit;

    //     return $this;
    // }

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

    // public function getProduitEpargne(): ?ProduitEpargne
    // {
    //     return $this->ProduitEpargne;
    // }

    // public function setProduitEpargne(?ProduitEpargne $ProduitEpargne): self
    // {
    //     $this->ProduitEpargne = $ProduitEpargne;

    //     return $this;
    // }

>>>>>>> refs/remotes/origin/main
    public function getSoldeEpargne(): ?string
    {
        return $this->SoldeEpargne;
    }

    public function setSoldeEpargne(string $SoldeEpargne): self
    {
        $this->SoldeEpargne = $SoldeEpargne;

        return $this;
    }

<<<<<<< HEAD
=======
    // public function getButCredit(): ?string
    // {
    //     return $this->ButCredit;
    // }

    // public function setButCredit(string $ButCredit): self
    // {
    //     $this->ButCredit = $ButCredit;

    //     return $this;
    // }
>>>>>>> refs/remotes/origin/main
    public function isCalculInteretDiffere(): ?bool
    {
        return $this->CalculInteretDiffere;
    }

    public function setCalculInteretDiffere(bool $CalculInteretDiffere): self
    {
        $this->CalculInteretDiffere = $CalculInteretDiffere;

        return $this;
    }

<<<<<<< HEAD
=======
    // public function isInteretDifferePaiementCapitalise(): ?bool
    // {
    //     return $this->InteretDifferePaiementCapitalise;
    // }

    // public function setInteretDifferePaiementCapitalise(bool $InteretDifferePaiementCapitalise): self
    // {
    //     $this->InteretDifferePaiementCapitalise = $InteretDifferePaiementCapitalise;

    //     return $this;
    // }

    // public function isInteretPayeMemePourDiffere(): ?bool
    // {
    //     return $this->InteretPayeMemePourDiffere;
    // }

    // public function setInteretPayeMemePourDiffere(bool $InteretPayeMemePourDiffere): self
    // {
    //     $this->InteretPayeMemePourDiffere = $InteretPayeMemePourDiffere;

    //     return $this;
    // }

    // public function isTrancheDistinctInteretPeriodeDiffere(): ?bool
    // {
    //     return $this->TrancheDistinctInteretPeriodeDiffere;
    // }

    // public function setTrancheDistinctInteretPeriodeDiffere(bool $TrancheDistinctInteretPeriodeDiffere): self
    // {
    //     $this->TrancheDistinctInteretPeriodeDiffere = $TrancheDistinctInteretPeriodeDiffere;

    //     return $this;
    // }

    // public function isPaiementPrealableInteret(): ?bool
    // {
    //     return $this->PaiementPrealableInteret;
    // }

    // public function setPaiementPrealableInteret(bool $PaiementPrealableInteret): self
    // {
    //     $this->PaiementPrealableInteret = $PaiementPrealableInteret;

    //     return $this;
    // }

    // public function isInteretDeduitDecaissement(): ?bool
    // {
    //     return $this->InteretDeduitDecaissement;
    // }

    // public function setInteretDeduitDecaissement(bool $InteretDeduitDecaissement): self
    // {
    //     $this->InteretDeduitDecaissement = $InteretDeduitDecaissement;

    //     return $this;
    // }

>>>>>>> refs/remotes/origin/main
    public function isCalculInteretJours(): ?bool
    {
        return $this->CalculInteretJours;
    }

    public function setCalculInteretJours(bool $CalculInteretJours): self
    {
        $this->CalculInteretJours = $CalculInteretJours;

        return $this;
    }
<<<<<<< HEAD
=======

    // public function isForfaitPaiementPrealableInteret(): ?bool
    // {
    //     return $this->ForfaitPaiementPrealableInteret;
    // }

    // public function setForfaitPaiementPrealableInteret(bool $ForfaitPaiementPrealableInteret): self
    // {
    //     $this->ForfaitPaiementPrealableInteret = $ForfaitPaiementPrealableInteret;

    //     return $this;
    // }

    // public function isCreditLieUSD(): ?bool
    // {
    //     return $this->CreditLieUSD;
    // }

    // public function setCreditLieUSD(bool $CreditLieUSD): self
    // {
    //     $this->CreditLieUSD = $CreditLieUSD;

    //     return $this;
    // }

    // public function isMettreJourCalendrierNonOuvrable(): ?bool
    // {
    //     return $this->MettreJourCalendrierNonOuvrable;
    // }

    // public function setMettreJourCalendrierNonOuvrable(bool $MettreJourCalendrierNonOuvrable): self
    // {
    //     $this->MettreJourCalendrierNonOuvrable = $MettreJourCalendrierNonOuvrable;

    //     return $this;
    // }

    // public function isReporterPremierTranche(): ?bool
    // {
    //     return $this->ReporterPremierTranche;
    // }

    // public function setReporterPremierTranche(bool $ReporterPremierTranche): self
    // {
    //     $this->ReporterPremierTranche = $ReporterPremierTranche;

    //     return $this;
    // }

    // public function isCommissionPourcentageMontantCredit(): ?bool
    // {
    //     return $this->CommissionPourcentageMontantCredit;
    // }

    // public function setCommissionPourcentageMontantCredit(bool $CommissionPourcentageMontantCredit): self
    // {
    //     $this->CommissionPourcentageMontantCredit = $CommissionPourcentageMontantCredit;

    //     return $this;
    // }

    // public function getPourcentageCapitalEnCoursInteretCommission(): ?float
    // {
    //     return $this->PourcentageCapitalEnCoursInteretCommission;
    // }

    // public function setPourcentageCapitalEnCoursInteretCommission(float $PourcentageCapitalEnCoursInteretCommission): self
    // {
    //     $this->PourcentageCapitalEnCoursInteretCommission = $PourcentageCapitalEnCoursInteretCommission;

    //     return $this;
    // }

    // public function getMontantFixeParTranche(): ?float
    // {
    //     return $this->MontantFixeParTranche;
    // }

    // public function setMontantFixeParTranche(float $MontantFixeParTranche): self
    // {
    //     $this->MontantFixeParTranche = $MontantFixeParTranche;

    //     return $this;
    // }

>>>>>>> refs/remotes/origin/main
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

    public function getFondCredit(): ?FondCredit
    {
        return $this->FondCredit;
    }

    public function setFondCredit(?FondCredit $FondCredit): self
    {
        $this->FondCredit = $FondCredit;

        return $this;
    }

    public function getTypeAmortissement(): ?string
    {
        return $this->typeAmortissement;
    }

    public function setTypeAmortissement(string $typeAmortissement): self
    {
        $this->typeAmortissement = $typeAmortissement;

        return $this;
    }

    public function getGarant(): ?string
    {
        return $this->garant;
    }

    public function setGarant(?string $garant): self
    {
        $this->garant = $garant;

        return $this;
    }

    public function getGarantie(): ?string
    {
        return $this->garantie;
    }

    public function setGarantie(?string $garantie): self
    {
        $this->garantie = $garantie;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->Valeur;
    }

    public function setValeur(?int $Valeur): self
    {
        $this->Valeur = $Valeur;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getValeurUnitaure(): ?string
    {
        return $this->ValeurUnitaure;
    }

    public function setValeurUnitaure(?string $ValeurUnitaure): self
    {
        $this->ValeurUnitaure = $ValeurUnitaure;

        return $this;
    }

    public function getUnite(): ?int
    {
        return $this->Unite;
    }

    public function setUnite(?int $Unite): self
    {
        $this->Unite = $Unite;

        return $this;
    }

    public function getValeurTotal(): ?int
    {
        return $this->ValeurTotal;
    }

    public function setValeurTotal(?int $ValeurTotal): self
    {
        $this->ValeurTotal = $ValeurTotal;

        return $this;
    }

    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function getCycles(): ?int
    {
        return $this->cycles;
    }

    public function setCycles(?int $cycles): self
    {
        $this->cycles = $cycles;

        return $this;
    }

    public function getCategorieCredit(): ?CategorieCredit
    {
        return $this->categorieCredit;
    }

    public function setCategorieCredit(?CategorieCredit $categorieCredit): self
    {
        $this->categorieCredit = $categorieCredit;

        return $this;
    }
}
