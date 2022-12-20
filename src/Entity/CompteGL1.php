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

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?ProduitCredit $ProduitCredit = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteProvisionMauvaiseCreances = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CptePrincipaleEnCours = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CptePrvsionCoutMauvaiseCreance = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteInteretRecuCredit = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteCreditPassePerte = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteInteretEchus = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteInteretEchusRecevoir = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteRefinancementCredit = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CptePnlteComptabliliseAvance = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteRevenuePnlteComptblsAvnc = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteCommissionEchuesAccumulle = null;

    #[ORM\ManyToOne(inversedBy: 'compteGL1s')]
    private ?PlanComptable $CpteCommissionAccumulleGagne = null;

    #[ORM\ManyToOne(inversedBy: 'CpteRecvrmntCreanceDouteuse')]
    private ?PlanComptable $CpteRecvrmntCreanceDouteuse = null;

    #[ORM\ManyToOne(inversedBy: 'CptePapeterie')]
    private ?PlanComptable $CptePapeterie = null;

    #[ORM\ManyToOne(inversedBy: 'CpteCheque')]
    private ?PlanComptable $CpteCheque = null;

    #[ORM\ManyToOne(inversedBy: 'CpteSurpaiement')]
    private ?PlanComptable $CpteSurpaiement = null;

    #[ORM\ManyToOne(inversedBy: 'CpteChargeCheque')]
    private ?PlanComptable $CpteChargeCheque = null;

    #[ORM\ManyToOne(inversedBy: 'CpteCommissionCredit')]
    private ?PlanComptable $CpteCommissionCredit = null;

    #[ORM\ManyToOne(inversedBy: 'CptePnlteCrdt')]
    private ?PlanComptable $CptePnlteCrdt = null;

    #[ORM\ManyToOne(inversedBy: 'DifferenceMonnaie')]
    private ?PlanComptable $DifferenceMonnaie = null;

    #[ORM\ManyToOne(inversedBy: 'Papeterie')]
    private ?PlanComptable $Papeterie = null;

    #[ORM\ManyToOne(inversedBy: 'Commission')]
    private ?PlanComptable $Commission = null;

    #[ORM\ManyToOne(inversedBy: 'FraisDeveloppement')]
    private ?PlanComptable $FraisDeveloppement = null;

    #[ORM\ManyToOne(inversedBy: 'FraisRefinancement')]
    private ?PlanComptable $FraisRefinancement = null;

    #[ORM\ManyToOne(inversedBy: 'PapeterieDecaissement')]
    private ?PlanComptable $PapeterieDecaissement = null;

    #[ORM\ManyToOne(inversedBy: 'CommisssionDecaissement')]
    private ?PlanComptable $CommisssionDecaissement = null;

    #[ORM\ManyToOne(inversedBy: 'CommisssionDecaissement')]
    private ?PlanComptable $MajorationDecaissement = null;

    #[ORM\ManyToOne(inversedBy: 'FraisDvlppmntDecaissement')]
    private ?PlanComptable $FraisDvlppmntDecaissement = null;

    #[ORM\ManyToOne(inversedBy: 'FraisDvlppmntDecaissement')]
    private ?PlanComptable $FraisTraitementDecaissement = null;

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

    public function getCpteProvisionMauvaiseCreances(): ?PlanComptable
    {
        return $this->CpteProvisionMauvaiseCreances;
    }

    public function setCpteProvisionMauvaiseCreances(?PlanComptable $CpteProvisionMauvaiseCreances): self
    {
        $this->CpteProvisionMauvaiseCreances = $CpteProvisionMauvaiseCreances;

        return $this;
    }

    public function getCptePrincipaleEnCours(): ?PlanComptable
    {
        return $this->CptePrincipaleEnCours;
    }

    public function setCptePrincipaleEnCours(?PlanComptable $CptePrincipaleEnCours): self
    {
        $this->CptePrincipaleEnCours = $CptePrincipaleEnCours;

        return $this;
    }

    public function getCptePrvsionCoutMauvaiseCreance(): ?PlanComptable
    {
        return $this->CptePrvsionCoutMauvaiseCreance;
    }

    public function setCptePrvsionCoutMauvaiseCreance(?PlanComptable $CptePrvsionCoutMauvaiseCreance): self
    {
        $this->CptePrvsionCoutMauvaiseCreance = $CptePrvsionCoutMauvaiseCreance;

        return $this;
    }

    public function getCpteInteretRecuCredit(): ?PlanComptable
    {
        return $this->CpteInteretRecuCredit;
    }

    public function setCpteInteretRecuCredit(?PlanComptable $CpteInteretRecuCredit): self
    {
        $this->CpteInteretRecuCredit = $CpteInteretRecuCredit;

        return $this;
    }

    public function getCpteCreditPassePerte(): ?PlanComptable
    {
        return $this->CpteCreditPassePerte;
    }

    public function setCpteCreditPassePerte(?PlanComptable $CpteCreditPassePerte): self
    {
        $this->CpteCreditPassePerte = $CpteCreditPassePerte;

        return $this;
    }

    public function getCpteInteretEchus(): ?PlanComptable
    {
        return $this->CpteInteretEchus;
    }

    public function setCpteInteretEchus(?PlanComptable $CpteInteretEchus): self
    {
        $this->CpteInteretEchus = $CpteInteretEchus;

        return $this;
    }

    public function getCpteInteretEchusRecevoir(): ?PlanComptable
    {
        return $this->CpteInteretEchusRecevoir;
    }

    public function setCpteInteretEchusRecevoir(?PlanComptable $CpteInteretEchusRecevoir): self
    {
        $this->CpteInteretEchusRecevoir = $CpteInteretEchusRecevoir;

        return $this;
    }

    public function getCpteRefinancementCredit(): ?PlanComptable
    {
        return $this->CpteRefinancementCredit;
    }

    public function setCpteRefinancementCredit(?PlanComptable $CpteRefinancementCredit): self
    {
        $this->CpteRefinancementCredit = $CpteRefinancementCredit;

        return $this;
    }

    public function getCptePnlteComptabliliseAvance(): ?PlanComptable
    {
        return $this->CptePnlteComptabliliseAvance;
    }

    public function setCptePnlteComptabliliseAvance(?PlanComptable $CptePnlteComptabliliseAvance): self
    {
        $this->CptePnlteComptabliliseAvance = $CptePnlteComptabliliseAvance;

        return $this;
    }

    public function getCpteRevenuePnlteComptblsAvnc(): ?PlanComptable
    {
        return $this->CpteRevenuePnlteComptblsAvnc;
    }

    public function setCpteRevenuePnlteComptblsAvnc(?PlanComptable $CpteRevenuePnlteComptblsAvnc): self
    {
        $this->CpteRevenuePnlteComptblsAvnc = $CpteRevenuePnlteComptblsAvnc;

        return $this;
    }

    public function getCpteCommissionEchuesAccumulle(): ?PlanComptable
    {
        return $this->CpteCommissionEchuesAccumulle;
    }

    public function setCpteCommissionEchuesAccumulle(?PlanComptable $CpteCommissionEchuesAccumulle): self
    {
        $this->CpteCommissionEchuesAccumulle = $CpteCommissionEchuesAccumulle;

        return $this;
    }

    public function getCpteCommissionAccumulleGagne(): ?PlanComptable
    {
        return $this->CpteCommissionAccumulleGagne;
    }

    public function setCpteCommissionAccumulleGagne(?PlanComptable $CpteCommissionAccumulleGagne): self
    {
        $this->CpteCommissionAccumulleGagne = $CpteCommissionAccumulleGagne;

        return $this;
    }

    public function getCpteRecvrmntCreanceDouteuse(): ?PlanComptable
    {
        return $this->CpteRecvrmntCreanceDouteuse;
    }

    public function setCpteRecvrmntCreanceDouteuse(?PlanComptable $CpteRecvrmntCreanceDouteuse): self
    {
        $this->CpteRecvrmntCreanceDouteuse = $CpteRecvrmntCreanceDouteuse;

        return $this;
    }

    public function getCptePapeterie(): ?PlanComptable
    {
        return $this->CptePapeterie;
    }

    public function setCptePapeterie(?PlanComptable $CptePapeterie): self
    {
        $this->CptePapeterie = $CptePapeterie;

        return $this;
    }

    public function getCpteCheque(): ?PlanComptable
    {
        return $this->CpteCheque;
    }

    public function setCpteCheque(?PlanComptable $CpteCheque): self
    {
        $this->CpteCheque = $CpteCheque;

        return $this;
    }

    public function getCpteSurpaiement(): ?PlanComptable
    {
        return $this->CpteSurpaiement;
    }

    public function setCpteSurpaiement(?PlanComptable $CpteSurpaiement): self
    {
        $this->CpteSurpaiement = $CpteSurpaiement;

        return $this;
    }

    public function getCpteChargeCheque(): ?PlanComptable
    {
        return $this->CpteChargeCheque;
    }

    public function setCpteChargeCheque(?PlanComptable $CpteChargeCheque): self
    {
        $this->CpteChargeCheque = $CpteChargeCheque;

        return $this;
    }

    public function getCpteCommissionCredit(): ?PlanComptable
    {
        return $this->CpteCommissionCredit;
    }

    public function setCpteCommissionCredit(?PlanComptable $CpteCommissionCredit): self
    {
        $this->CpteCommissionCredit = $CpteCommissionCredit;

        return $this;
    }

    public function getCptePnlteCrdt(): ?PlanComptable
    {
        return $this->CptePnlteCrdt;
    }

    public function setCptePnlteCrdt(?PlanComptable $CptePnlteCrdt): self
    {
        $this->CptePnlteCrdt = $CptePnlteCrdt;

        return $this;
    }

    public function getDifferenceMonnaie(): ?PlanComptable
    {
        return $this->DifferenceMonnaie;
    }

    public function setDifferenceMonnaie(?PlanComptable $DifferenceMonnaie): self
    {
        $this->DifferenceMonnaie = $DifferenceMonnaie;

        return $this;
    }

    public function getPapeterie(): ?PlanComptable
    {
        return $this->Papeterie;
    }

    public function setPapeterie(?PlanComptable $Papeterie): self
    {
        $this->Papeterie = $Papeterie;

        return $this;
    }

    public function getCommission(): ?PlanComptable
    {
        return $this->Commission;
    }

    public function setCommission(?PlanComptable $Commission): self
    {
        $this->Commission = $Commission;

        return $this;
    }

    public function getFraisDeveloppement(): ?PlanComptable
    {
        return $this->FraisDeveloppement;
    }

    public function setFraisDeveloppement(?PlanComptable $FraisDeveloppement): self
    {
        $this->FraisDeveloppement = $FraisDeveloppement;

        return $this;
    }

    public function getFraisRefinancement(): ?PlanComptable
    {
        return $this->FraisRefinancement;
    }

    public function setFraisRefinancement(?PlanComptable $FraisRefinancement): self
    {
        $this->FraisRefinancement = $FraisRefinancement;

        return $this;
    }

    public function getPapeterieDecaissement(): ?PlanComptable
    {
        return $this->PapeterieDecaissement;
    }

    public function setPapeterieDecaissement(?PlanComptable $PapeterieDecaissement): self
    {
        $this->PapeterieDecaissement = $PapeterieDecaissement;

        return $this;
    }

    public function getCommisssionDecaissement(): ?PlanComptable
    {
        return $this->CommisssionDecaissement;
    }

    public function setCommisssionDecaissement(?PlanComptable $CommisssionDecaissement): self
    {
        $this->CommisssionDecaissement = $CommisssionDecaissement;

        return $this;
    }

    public function getMajorationDecaissement(): ?PlanComptable
    {
        return $this->MajorationDecaissement;
    }

    public function setMajorationDecaissement(?PlanComptable $MajorationDecaissement): self
    {
        $this->MajorationDecaissement = $MajorationDecaissement;

        return $this;
    }

    public function getFraisDvlppmntDecaissement(): ?PlanComptable
    {
        return $this->FraisDvlppmntDecaissement;
    }

    public function setFraisDvlppmntDecaissement(?PlanComptable $FraisDvlppmntDecaissement): self
    {
        $this->FraisDvlppmntDecaissement = $FraisDvlppmntDecaissement;

        return $this;
    }

    public function getFraisTraitementDecaissement(): ?PlanComptable
    {
        return $this->FraisTraitementDecaissement;
    }

    public function setFraisTraitementDecaissement(?PlanComptable $FraisTraitementDecaissement): self
    {
        $this->FraisTraitementDecaissement = $FraisTraitementDecaissement;

        return $this;
    }
}
