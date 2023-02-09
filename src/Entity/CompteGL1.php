<?php

namespace App\Entity;

use App\Repository\CompteGL1Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteGL1Repository::class)]
class CompteGL1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ProduitCompteGL1')]
    private ?ProduitCredit $ProduitCredit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CptePrncplEnCours = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteProvisionMvsCreances = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteProvsionCoutMvsCreance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CptIntrtRecuCrdt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteCrdtPassePerte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteInteretEchus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteIntrtEchusRecvoir = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteRefinancmntCrdt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CptePnltsComptblsAvnce = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteRvnuePnltsComptblsAvnce = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteCommssionAccmlGagne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteRcvrmtCrncsDouteuse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CptePapeterie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteCheque = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteSurpaiement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteChrgCheque = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CpteCommssionCrdt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CptePnltsCrdt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DiffrnceMonnaie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PapeterieDemande = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CommissionDemande = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FraisDeveloppementDmd = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FraisRefinancementDemande = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PapeterieDecaissement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CommissionDecaissement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MajorationDecaissement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FraisDeveloppementDecssmnt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FraisTrtementDecaissement = null;


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

    public function getCptePrncplEnCours(): ?string
    {
        return $this->CptePrncplEnCours;
    }

    public function setCptePrncplEnCours(?string $CptePrncplEnCours): self
    {
        $this->CptePrncplEnCours = $CptePrncplEnCours;

        return $this;
    }

    public function getCpteProvisionMvsCreances(): ?string
    {
        return $this->CpteProvisionMvsCreances;
    }

    public function setCpteProvisionMvsCreances(?string $CpteProvisionMvsCreances): self
    {
        $this->CpteProvisionMvsCreances = $CpteProvisionMvsCreances;

        return $this;
    }

    public function getCpteProvsionCoutMvsCreance(): ?string
    {
        return $this->CpteProvsionCoutMvsCreance;
    }

    public function setCpteProvsionCoutMvsCreance(?string $CpteProvsionCoutMvsCreance): self
    {
        $this->CpteProvsionCoutMvsCreance = $CpteProvsionCoutMvsCreance;

        return $this;
    }

    public function getCptIntrtRecuCrdt(): ?string
    {
        return $this->CptIntrtRecuCrdt;
    }

    public function setCptIntrtRecuCrdt(?string $CptIntrtRecuCrdt): self
    {
        $this->CptIntrtRecuCrdt = $CptIntrtRecuCrdt;

        return $this;
    }

    public function getCpteCrdtPassePerte(): ?string
    {
        return $this->CpteCrdtPassePerte;
    }

    public function setCpteCrdtPassePerte(?string $CpteCrdtPassePerte): self
    {
        $this->CpteCrdtPassePerte = $CpteCrdtPassePerte;

        return $this;
    }

    public function getCpteInteretEchus(): ?string
    {
        return $this->CpteInteretEchus;
    }

    public function setCpteInteretEchus(?string $CpteInteretEchus): self
    {
        $this->CpteInteretEchus = $CpteInteretEchus;

        return $this;
    }

    public function getCpteIntrtEchusRecvoir(): ?string
    {
        return $this->CpteIntrtEchusRecvoir;
    }

    public function setCpteIntrtEchusRecvoir(?string $CpteIntrtEchusRecvoir): self
    {
        $this->CpteIntrtEchusRecvoir = $CpteIntrtEchusRecvoir;

        return $this;
    }

    public function getCpteRefinancmntCrdt(): ?string
    {
        return $this->CpteRefinancmntCrdt;
    }

    public function setCpteRefinancmntCrdt(?string $CpteRefinancmntCrdt): self
    {
        $this->CpteRefinancmntCrdt = $CpteRefinancmntCrdt;

        return $this;
    }

    public function getCptePnltsComptblsAvnce(): ?string
    {
        return $this->CptePnltsComptblsAvnce;
    }

    public function setCptePnltsComptblsAvnce(?string $CptePnltsComptblsAvnce): self
    {
        $this->CptePnltsComptblsAvnce = $CptePnltsComptblsAvnce;

        return $this;
    }

    public function getCpteRvnuePnltsComptblsAvnce(): ?string
    {
        return $this->CpteRvnuePnltsComptblsAvnce;
    }

    public function setCpteRvnuePnltsComptblsAvnce(?string $CpteRvnuePnltsComptblsAvnce): self
    {
        $this->CpteRvnuePnltsComptblsAvnce = $CpteRvnuePnltsComptblsAvnce;

        return $this;
    }

    public function getCpteCommssionAccmlGagne(): ?string
    {
        return $this->CpteCommssionAccmlGagne;
    }

    public function setCpteCommssionAccmlGagne(?string $CpteCommssionAccmlGagne): self
    {
        $this->CpteCommssionAccmlGagne = $CpteCommssionAccmlGagne;

        return $this;
    }

    public function getCpteRcvrmtCrncsDouteuse(): ?string
    {
        return $this->CpteRcvrmtCrncsDouteuse;
    }

    public function setCpteRcvrmtCrncsDouteuse(?string $CpteRcvrmtCrncsDouteuse): self
    {
        $this->CpteRcvrmtCrncsDouteuse = $CpteRcvrmtCrncsDouteuse;

        return $this;
    }

    public function getCptePapeterie(): ?string
    {
        return $this->CptePapeterie;
    }

    public function setCptePapeterie(?string $CptePapeterie): self
    {
        $this->CptePapeterie = $CptePapeterie;

        return $this;
    }

    public function getCpteCheque(): ?string
    {
        return $this->CpteCheque;
    }

    public function setCpteCheque(?string $CpteCheque): self
    {
        $this->CpteCheque = $CpteCheque;

        return $this;
    }

    public function getCpteSurpaiement(): ?string
    {
        return $this->CpteSurpaiement;
    }

    public function setCpteSurpaiement(?string $CpteSurpaiement): self
    {
        $this->CpteSurpaiement = $CpteSurpaiement;

        return $this;
    }

    public function getCpteChrgCheque(): ?string
    {
        return $this->CpteChrgCheque;
    }

    public function setCpteChrgCheque(?string $CpteChrgCheque): self
    {
        $this->CpteChrgCheque = $CpteChrgCheque;

        return $this;
    }

    public function getCpteCommssionCrdt(): ?string
    {
        return $this->CpteCommssionCrdt;
    }

    public function setCpteCommssionCrdt(?string $CpteCommssionCrdt): self
    {
        $this->CpteCommssionCrdt = $CpteCommssionCrdt;

        return $this;
    }

    public function getCptePnltsCrdt(): ?string
    {
        return $this->CptePnltsCrdt;
    }

    public function setCptePnltsCrdt(string $CptePnltsCrdt): self
    {
        $this->CptePnltsCrdt = $CptePnltsCrdt;

        return $this;
    }

    public function getDiffrnceMonnaie(): ?string
    {
        return $this->DiffrnceMonnaie;
    }

    public function setDiffrnceMonnaie(?string $DiffrnceMonnaie): self
    {
        $this->DiffrnceMonnaie = $DiffrnceMonnaie;

        return $this;
    }

    public function getPapeterieDemande(): ?string
    {
        return $this->PapeterieDemande;
    }

    public function setPapeterieDemande(?string $PapeterieDemande): self
    {
        $this->PapeterieDemande = $PapeterieDemande;

        return $this;
    }

    public function getCommissionDemande(): ?string
    {
        return $this->CommissionDemande;
    }

    public function setCommissionDemande(?string $CommissionDemande): self
    {
        $this->CommissionDemande = $CommissionDemande;

        return $this;
    }

    public function getFraisDeveloppementDmd(): ?string
    {
        return $this->FraisDeveloppementDmd;
    }

    public function setFraisDeveloppementDmd(?string $FraisDeveloppementDmd): self
    {
        $this->FraisDeveloppementDmd = $FraisDeveloppementDmd;

        return $this;
    }

    public function getFraisRefinancementDemande(): ?string
    {
        return $this->FraisRefinancementDemande;
    }

    public function setFraisRefinancementDemande(?string $FraisRefinancementDemande): self
    {
        $this->FraisRefinancementDemande = $FraisRefinancementDemande;

        return $this;
    }

    public function getPapeterieDecaissement(): ?string
    {
        return $this->PapeterieDecaissement;
    }

    public function setPapeterieDecaissement(?string $PapeterieDecaissement): self
    {
        $this->PapeterieDecaissement = $PapeterieDecaissement;

        return $this;
    }

    public function getCommissionDecaissement(): ?string
    {
        return $this->CommissionDecaissement;
    }

    public function setCommissionDecaissement(?string $CommissionDecaissement): self
    {
        $this->CommissionDecaissement = $CommissionDecaissement;

        return $this;
    }

    public function getMajorationDecaissement(): ?string
    {
        return $this->MajorationDecaissement;
    }

    public function setMajorationDecaissement(?string $MajorationDecaissement): self
    {
        $this->MajorationDecaissement = $MajorationDecaissement;

        return $this;
    }

    public function getFraisDeveloppementDecssmnt(): ?string
    {
        return $this->FraisDeveloppementDecssmnt;
    }

    public function setFraisDeveloppementDecssmnt(?string $FraisDeveloppementDecssmnt): self
    {
        $this->FraisDeveloppementDecssmnt = $FraisDeveloppementDecssmnt;

        return $this;
    }

    public function getFraisTrtementDecaissement(): ?string
    {
        return $this->FraisTrtementDecaissement;
    }

    public function setFraisTrtementDecaissement(?string $FraisTrtementDecaissement): self
    {
        $this->FraisTrtementDecaissement = $FraisTrtementDecaissement;

        return $this;
    }

}
