<?php

namespace App\Entity;

use App\Repository\PenaliteCreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PenaliteCreditRepository::class)]
class PenaliteCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'penaliteCredits')]
    private ?ProduitCredit $ProduitCredit = null;

    // #[ORM\Column(nullable: true)]
    // private ?bool $CalculMontantFixe = null;

    #[ORM\Column(nullable: true)]
    private ?bool $CalculMntntFixParOccasion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $PnlitePourcntgDurntunPeriod = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ClculCommPourctngSimple = null;

    #[ORM\Column(nullable: true)]
    private ?bool $CalculSlnNbrSemne = null;

    #[ORM\Column(nullable: true)]
    private ?bool $CalculSmplPrctgSoldImpaye = null;

    #[ORM\Column(nullable: true)]
    private ?bool $CalculSurArrierePrcpl = null;

    #[ORM\Column(nullable: true)]
    private ?bool $SurArrierPrcplIntrt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $SurPrcplIntrtPnltArriere = null;

    #[ORM\Column(nullable: true)]
    private ?float $PenalitMinimum = null;

    #[ORM\Column(nullable: true)]
    private ?float $PenalitMaximum = null;

    // #[ORM\Column(nullable: true)]
    // private ?float $PenaliteCalclPourMax = null;

    #[ORM\Column(nullable: true)]
    private ?bool $CalculAutoPenalite = null;

    #[ORM\Column(nullable: true)]
    private ?bool $CalculPenaliteAlaConnection = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ClclPnltSrIntrtCptlsEtPnltArr = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ClclPnltSiJrArrierDpassDlGrass = null;

    #[ORM\Column(nullable: true)]
    private ?bool $TrnsferAutoFondCptEprgnAuxCptCrdt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $UtilseSoldeMin = null;

    #[ORM\Column(nullable: true)]
    private ?float $JourMinimumArriere = null;

    #[ORM\Column(nullable: true)]
    private ?bool $PnltClclCmmMntnFixPrJr = null;

    #[ORM\Column(nullable: true)]
    private ?bool $PnltBsSrMntntDuPrTrnches = null;

    #[ORM\Column(nullable: true)]
    private ?bool $PnltPrChqTrnchRtrd = null;

    #[ORM\Column(nullable: true)]
    private ?bool $PnltJourFerierEtWE = null;

    #[ORM\Column(nullable: true)]
    private ?float $PenaliteComme = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DiffePaimntEnNbrJrAvntPnltImps = null;

    #[ORM\Column(nullable: true)]
    private ?bool $InclrCrdtAvcMntntDusAuJrRapprt = null;

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

    // public function isCalculMontantFixe(): ?bool
    // {
    //     return $this->CalculMontantFixe;
    // }

    // public function setCalculMontantFixe(?bool $CalculMontantFixe): self
    // {
    //     $this->CalculMontantFixe = $CalculMontantFixe;

    //     return $this;
    // }

    public function isCalculMntntFixParOccasion(): ?bool
    {
        return $this->CalculMntntFixParOccasion;
    }

    public function setCalculMntntFixParOccasion(?bool $CalculMntntFixParOccasion): self
    {
        $this->CalculMntntFixParOccasion = $CalculMntntFixParOccasion;

        return $this;
    }

    public function isPnlitePourcntgDurntunPeriod(): ?bool
    {
        return $this->PnlitePourcntgDurntunPeriod;
    }

    public function setPnlitePourcntgDurntunPeriod(?bool $PnlitePourcntgDurntunPeriod): self
    {
        $this->PnlitePourcntgDurntunPeriod = $PnlitePourcntgDurntunPeriod;

        return $this;
    }

    public function isClculCommPourctngSimple(): ?bool
    {
        return $this->ClculCommPourctngSimple;
    }

    public function setClculCommPourctngSimple(?bool $ClculCommPourctngSimple): self
    {
        $this->ClculCommPourctngSimple = $ClculCommPourctngSimple;

        return $this;
    }

    public function isCalculSlnNbrSemne(): ?bool
    {
        return $this->CalculSlnNbrSemne;
    }

    public function setCalculSlnNbrSemne(?bool $CalculSlnNbrSemne): self
    {
        $this->CalculSlnNbrSemne = $CalculSlnNbrSemne;

        return $this;
    }

    public function isCalculSmplPrctgSoldImpaye(): ?bool
    {
        return $this->CalculSmplPrctgSoldImpaye;
    }

    public function setCalculSmplPrctgSoldImpaye(?bool $CalculSmplPrctgSoldImpaye): self
    {
        $this->CalculSmplPrctgSoldImpaye = $CalculSmplPrctgSoldImpaye;

        return $this;
    }

    public function isCalculSurArrierePrcpl(): ?bool
    {
        return $this->CalculSurArrierePrcpl;
    }

    public function setCalculSurArrierePrcpl(?bool $CalculSurArrierePrcpl): self
    {
        $this->CalculSurArrierePrcpl = $CalculSurArrierePrcpl;

        return $this;
    }

    public function isSurArrierPrcplIntrt(): ?bool
    {
        return $this->SurArrierPrcplIntrt;
    }

    public function setSurArrierPrcplIntrt(?bool $SurArrierPrcplIntrt): self
    {
        $this->SurArrierPrcplIntrt = $SurArrierPrcplIntrt;

        return $this;
    }

    public function isSurPrcplIntrtPnltArriere(): ?bool
    {
        return $this->SurPrcplIntrtPnltArriere;
    }

    public function setSurPrcplIntrtPnltArriere(?bool $SurPrcplIntrtPnltArriere): self
    {
        $this->SurPrcplIntrtPnltArriere = $SurPrcplIntrtPnltArriere;

        return $this;
    }

    public function getPenalitMinimum(): ?float
    {
        return $this->PenalitMinimum;
    }

    public function setPenalitMinimum(?float $PenalitMinimum): self
    {
        $this->PenalitMinimum = $PenalitMinimum;

        return $this;
    }

    public function getPenalitMaximum(): ?float
    {
        return $this->PenalitMaximum;
    }

    public function setPenalitMaximum(?float $PenalitMaximum): self
    {
        $this->PenalitMaximum = $PenalitMaximum;

        return $this;
    }

    // public function getPenaliteCalclPourMax(): ?float
    // {
    //     return $this->PenaliteCalclPourMax;
    // }

    // public function setPenaliteCalclPourMax(?float $PenaliteCalclPourMax): self
    // {
    //     $this->PenaliteCalclPourMax = $PenaliteCalclPourMax;

    //     return $this;
    // }

    public function isCalculAutoPenalite(): ?bool
    {
        return $this->CalculAutoPenalite;
    }

    public function setCalculAutoPenalite(?bool $CalculAutoPenalite): self
    {
        $this->CalculAutoPenalite = $CalculAutoPenalite;

        return $this;
    }

    public function isCalculPenaliteAlaConnection(): ?bool
    {
        return $this->CalculPenaliteAlaConnection;
    }

    public function setCalculPenaliteAlaConnection(?bool $CalculPenaliteAlaConnection): self
    {
        $this->CalculPenaliteAlaConnection = $CalculPenaliteAlaConnection;

        return $this;
    }

    public function isClclPnltSrIntrtCptlsEtPnltArr(): ?bool
    {
        return $this->ClclPnltSrIntrtCptlsEtPnltArr;
    }

    public function setClclPnltSrIntrtCptlsEtPnltArr(?bool $ClclPnltSrIntrtCptlsEtPnltArr): self
    {
        $this->ClclPnltSrIntrtCptlsEtPnltArr = $ClclPnltSrIntrtCptlsEtPnltArr;

        return $this;
    }

    public function isClclPnltSiJrArrierDpassDlGrass(): ?bool
    {
        return $this->ClclPnltSiJrArrierDpassDlGrass;
    }

    public function setClclPnltSiJrArrierDpassDlGrass(?bool $ClclPnltSiJrArrierDpassDlGrass): self
    {
        $this->ClclPnltSiJrArrierDpassDlGrass = $ClclPnltSiJrArrierDpassDlGrass;

        return $this;
    }

    public function isTrnsferAutoFondCptEprgnAuxCptCrdt(): ?bool
    {
        return $this->TrnsferAutoFondCptEprgnAuxCptCrdt;
    }

    public function setTrnsferAutoFondCptEprgnAuxCptCrdt(?bool $TrnsferAutoFondCptEprgnAuxCptCrdt): self
    {
        $this->TrnsferAutoFondCptEprgnAuxCptCrdt = $TrnsferAutoFondCptEprgnAuxCptCrdt;

        return $this;
    }

    public function isUtilseSoldeMin(): ?bool
    {
        return $this->UtilseSoldeMin;
    }

    public function setUtilseSoldeMin(?bool $UtilseSoldeMin): self
    {
        $this->UtilseSoldeMin = $UtilseSoldeMin;

        return $this;
    }

    public function getJourMinimumArriere(): ?float
    {
        return $this->JourMinimumArriere;
    }

    public function setJourMinimumArriere(?float $JourMinimumArriere): self
    {
        $this->JourMinimumArriere = $JourMinimumArriere;

        return $this;
    }

    public function isPnltClclCmmMntnFixPrJr(): ?bool
    {
        return $this->PnltClclCmmMntnFixPrJr;
    }

    public function setPnltClclCmmMntnFixPrJr(?bool $PnltClclCmmMntnFixPrJr): self
    {
        $this->PnltClclCmmMntnFixPrJr = $PnltClclCmmMntnFixPrJr;

        return $this;
    }

    public function isPnltBsSrMntntDuPrTrnches(): ?bool
    {
        return $this->PnltBsSrMntntDuPrTrnches;
    }

    public function setPnltBsSrMntntDuPrTrnches(?bool $PnltBsSrMntntDuPrTrnches): self
    {
        $this->PnltBsSrMntntDuPrTrnches = $PnltBsSrMntntDuPrTrnches;

        return $this;
    }

    public function isPnltPrChqTrnchRtrd(): ?bool
    {
        return $this->PnltPrChqTrnchRtrd;
    }

    public function setPnltPrChqTrnchRtrd(?bool $PnltPrChqTrnchRtrd): self
    {
        $this->PnltPrChqTrnchRtrd = $PnltPrChqTrnchRtrd;

        return $this;
    }

    public function isPnltJourFerierEtWE(): ?bool
    {
        return $this->PnltJourFerierEtWE;
    }

    public function setPnltJourFerierEtWE(?bool $PnltJourFerierEtWE): self
    {
        $this->PnltJourFerierEtWE = $PnltJourFerierEtWE;

        return $this;
    }

    public function getPenaliteComme(): ?float
    {
        return $this->PenaliteComme;
    }

    public function setPenaliteComme(?float $PenaliteComme): self
    {
        $this->PenaliteComme = $PenaliteComme;

        return $this;
    }

    public function getDiffePaimntEnNbrJrAvntPnltImps(): ?string
    {
        return $this->DiffePaimntEnNbrJrAvntPnltImps;
    }

    public function setDiffePaimntEnNbrJrAvntPnltImps(?string $DiffePaimntEnNbrJrAvntPnltImps): self
    {
        $this->DiffePaimntEnNbrJrAvntPnltImps = $DiffePaimntEnNbrJrAvntPnltImps;

        return $this;
    }

    public function isInclrCrdtAvcMntntDusAuJrRapprt(): ?bool
    {
        return $this->InclrCrdtAvcMntntDusAuJrRapprt;
    }

    public function setInclrCrdtAvcMntntDusAuJrRapprt(?bool $InclrCrdtAvcMntntDusAuJrRapprt): self
    {
        $this->InclrCrdtAvcMntntDusAuJrRapprt = $InclrCrdtAvcMntntDusAuJrRapprt;

        return $this;
    }
}
