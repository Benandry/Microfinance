<?php

namespace App\Entity;

use App\Repository\PlanComptableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanComptableRepository::class)]
class PlanComptable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NumeroCompte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Libelle = null;

    #[ORM\OneToMany(mappedBy: 'CpteProvisionMauvaiseCreances', targetEntity: CompteGL1::class)]
    private Collection $compteGL1s;

    #[ORM\OneToMany(mappedBy: 'CpteRecvrmntCreanceDouteuse', targetEntity: CompteGL1::class)]
    private Collection $CpteRecvrmntCreanceDouteuse;

    #[ORM\OneToMany(mappedBy: 'CptePapeterie', targetEntity: CompteGL1::class)]
    private Collection $CptePapeterie;

    #[ORM\OneToMany(mappedBy: 'CpteCheque', targetEntity: CompteGL1::class)]
    private Collection $CpteCheque;

    #[ORM\OneToMany(mappedBy: 'CpteSurpaiement', targetEntity: CompteGL1::class)]
    private Collection $CpteSurpaiement;

    #[ORM\OneToMany(mappedBy: 'CpteChargeCheque', targetEntity: CompteGL1::class)]
    private Collection $CpteChargeCheque;

    #[ORM\OneToMany(mappedBy: 'CpteCommissionCredit', targetEntity: CompteGL1::class)]
    private Collection $CpteCommissionCredit;

    #[ORM\OneToMany(mappedBy: 'CptePnlteCrdt', targetEntity: CompteGL1::class)]
    private Collection $CptePnlteCrdt;

    #[ORM\OneToMany(mappedBy: 'DifferenceMonnaie', targetEntity: CompteGL1::class)]
    private Collection $DifferenceMonnaie;

    #[ORM\OneToMany(mappedBy: 'Papeterie', targetEntity: CompteGL1::class)]
    private Collection $Papeterie;

    #[ORM\OneToMany(mappedBy: 'Commission', targetEntity: CompteGL1::class)]
    private Collection $Commission;

    #[ORM\OneToMany(mappedBy: 'FraisDeveloppement', targetEntity: CompteGL1::class)]
    private Collection $FraisDeveloppement;

    #[ORM\OneToMany(mappedBy: 'FraisRefinancement', targetEntity: CompteGL1::class)]
    private Collection $FraisRefinancement;

    #[ORM\OneToMany(mappedBy: 'PapeterieDecaissement', targetEntity: CompteGL1::class)]
    private Collection $PapeterieDecaissement;

    #[ORM\OneToMany(mappedBy: 'CommisssionDecaissement', targetEntity: CompteGL1::class)]
    private Collection $CommisssionDecaissement;

    #[ORM\OneToMany(mappedBy: 'FraisDvlppmntDecaissement', targetEntity: CompteGL1::class)]
    private Collection $FraisDvlppmntDecaissement;

    public function __construct()
    {
        $this->compteGL1s = new ArrayCollection();
        $this->CpteRecvrmntCreanceDouteuse = new ArrayCollection();
        $this->CptePapeterie = new ArrayCollection();
        $this->CpteCheque = new ArrayCollection();
        $this->CpteSurpaiement = new ArrayCollection();
        $this->CpteChargeCheque = new ArrayCollection();
        $this->CpteCommissionCredit = new ArrayCollection();
        $this->CptePnlteCrdt = new ArrayCollection();
        $this->DifferenceMonnaie = new ArrayCollection();
        $this->Papeterie = new ArrayCollection();
        $this->Commission = new ArrayCollection();
        $this->FraisDeveloppement = new ArrayCollection();
        $this->FraisRefinancement = new ArrayCollection();
        $this->PapeterieDecaissement = new ArrayCollection();
        $this->CommisssionDecaissement = new ArrayCollection();
        $this->FraisDvlppmntDecaissement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompte(): ?string
    {
        return $this->NumeroCompte;
    }

    public function setNumeroCompte(?string $NumeroCompte): self
    {
        $this->NumeroCompte = $NumeroCompte;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(?string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCompteGL1s(): Collection
    {
        return $this->compteGL1s;
    }

    public function addCompteGL1(CompteGL1 $compteGL1): self
    {
        if (!$this->compteGL1s->contains($compteGL1)) {
            $this->compteGL1s[] = $compteGL1;
            $compteGL1->setCpteProvisionMauvaiseCreances($this);
        }

        return $this;
    }

    public function removeCompteGL1(CompteGL1 $compteGL1): self
    {
        if ($this->compteGL1s->removeElement($compteGL1)) {
            // set the owning side to null (unless already changed)
            if ($compteGL1->getCpteProvisionMauvaiseCreances() === $this) {
                $compteGL1->setCpteProvisionMauvaiseCreances(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCpteRecvrmntCreanceDouteuse(): Collection
    {
        return $this->CpteRecvrmntCreanceDouteuse;
    }

    public function addCpteRecvrmntCreanceDouteuse(CompteGL1 $cpteRecvrmntCreanceDouteuse): self
    {
        if (!$this->CpteRecvrmntCreanceDouteuse->contains($cpteRecvrmntCreanceDouteuse)) {
            $this->CpteRecvrmntCreanceDouteuse[] = $cpteRecvrmntCreanceDouteuse;
            $cpteRecvrmntCreanceDouteuse->setCpteRecvrmntCreanceDouteuse($this);
        }

        return $this;
    }

    public function removeCpteRecvrmntCreanceDouteuse(CompteGL1 $cpteRecvrmntCreanceDouteuse): self
    {
        if ($this->CpteRecvrmntCreanceDouteuse->removeElement($cpteRecvrmntCreanceDouteuse)) {
            // set the owning side to null (unless already changed)
            if ($cpteRecvrmntCreanceDouteuse->getCpteRecvrmntCreanceDouteuse() === $this) {
                $cpteRecvrmntCreanceDouteuse->setCpteRecvrmntCreanceDouteuse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCptePapeterie(): Collection
    {
        return $this->CptePapeterie;
    }

    public function addCptePapeterie(CompteGL1 $cptePapeterie): self
    {
        if (!$this->CptePapeterie->contains($cptePapeterie)) {
            $this->CptePapeterie[] = $cptePapeterie;
            $cptePapeterie->setCptePapeterie($this);
        }

        return $this;
    }

    public function removeCptePapeterie(CompteGL1 $cptePapeterie): self
    {
        if ($this->CptePapeterie->removeElement($cptePapeterie)) {
            // set the owning side to null (unless already changed)
            if ($cptePapeterie->getCptePapeterie() === $this) {
                $cptePapeterie->setCptePapeterie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCpteCheque(): Collection
    {
        return $this->CpteCheque;
    }

    public function addCpteCheque(CompteGL1 $cpteCheque): self
    {
        if (!$this->CpteCheque->contains($cpteCheque)) {
            $this->CpteCheque[] = $cpteCheque;
            $cpteCheque->setCpteCheque($this);
        }

        return $this;
    }

    public function removeCpteCheque(CompteGL1 $cpteCheque): self
    {
        if ($this->CpteCheque->removeElement($cpteCheque)) {
            // set the owning side to null (unless already changed)
            if ($cpteCheque->getCpteCheque() === $this) {
                $cpteCheque->setCpteCheque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCpteSurpaiement(): Collection
    {
        return $this->CpteSurpaiement;
    }

    public function addCpteSurpaiement(CompteGL1 $cpteSurpaiement): self
    {
        if (!$this->CpteSurpaiement->contains($cpteSurpaiement)) {
            $this->CpteSurpaiement[] = $cpteSurpaiement;
            $cpteSurpaiement->setCpteSurpaiement($this);
        }

        return $this;
    }

    public function removeCpteSurpaiement(CompteGL1 $cpteSurpaiement): self
    {
        if ($this->CpteSurpaiement->removeElement($cpteSurpaiement)) {
            // set the owning side to null (unless already changed)
            if ($cpteSurpaiement->getCpteSurpaiement() === $this) {
                $cpteSurpaiement->setCpteSurpaiement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCpteChargeCheque(): Collection
    {
        return $this->CpteChargeCheque;
    }

    public function addCpteChargeCheque(CompteGL1 $cpteChargeCheque): self
    {
        if (!$this->CpteChargeCheque->contains($cpteChargeCheque)) {
            $this->CpteChargeCheque[] = $cpteChargeCheque;
            $cpteChargeCheque->setCpteChargeCheque($this);
        }

        return $this;
    }

    public function removeCpteChargeCheque(CompteGL1 $cpteChargeCheque): self
    {
        if ($this->CpteChargeCheque->removeElement($cpteChargeCheque)) {
            // set the owning side to null (unless already changed)
            if ($cpteChargeCheque->getCpteChargeCheque() === $this) {
                $cpteChargeCheque->setCpteChargeCheque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCpteCommissionCredit(): Collection
    {
        return $this->CpteCommissionCredit;
    }

    public function addCpteCommissionCredit(CompteGL1 $cpteCommissionCredit): self
    {
        if (!$this->CpteCommissionCredit->contains($cpteCommissionCredit)) {
            $this->CpteCommissionCredit[] = $cpteCommissionCredit;
            $cpteCommissionCredit->setCpteCommissionCredit($this);
        }

        return $this;
    }

    public function removeCpteCommissionCredit(CompteGL1 $cpteCommissionCredit): self
    {
        if ($this->CpteCommissionCredit->removeElement($cpteCommissionCredit)) {
            // set the owning side to null (unless already changed)
            if ($cpteCommissionCredit->getCpteCommissionCredit() === $this) {
                $cpteCommissionCredit->setCpteCommissionCredit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCptePnlteCrdt(): Collection
    {
        return $this->CptePnlteCrdt;
    }

    public function addCptePnlteCrdt(CompteGL1 $cptePnlteCrdt): self
    {
        if (!$this->CptePnlteCrdt->contains($cptePnlteCrdt)) {
            $this->CptePnlteCrdt[] = $cptePnlteCrdt;
            $cptePnlteCrdt->setCptePnlteCrdt($this);
        }

        return $this;
    }

    public function removeCptePnlteCrdt(CompteGL1 $cptePnlteCrdt): self
    {
        if ($this->CptePnlteCrdt->removeElement($cptePnlteCrdt)) {
            // set the owning side to null (unless already changed)
            if ($cptePnlteCrdt->getCptePnlteCrdt() === $this) {
                $cptePnlteCrdt->setCptePnlteCrdt(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getDifferenceMonnaie(): Collection
    {
        return $this->DifferenceMonnaie;
    }

    public function addDifferenceMonnaie(CompteGL1 $differenceMonnaie): self
    {
        if (!$this->DifferenceMonnaie->contains($differenceMonnaie)) {
            $this->DifferenceMonnaie[] = $differenceMonnaie;
            $differenceMonnaie->setDifferenceMonnaie($this);
        }

        return $this;
    }

    public function removeDifferenceMonnaie(CompteGL1 $differenceMonnaie): self
    {
        if ($this->DifferenceMonnaie->removeElement($differenceMonnaie)) {
            // set the owning side to null (unless already changed)
            if ($differenceMonnaie->getDifferenceMonnaie() === $this) {
                $differenceMonnaie->setDifferenceMonnaie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getPapeterie(): Collection
    {
        return $this->Papeterie;
    }

    public function addPapeterie(CompteGL1 $papeterie): self
    {
        if (!$this->Papeterie->contains($papeterie)) {
            $this->Papeterie[] = $papeterie;
            $papeterie->setPapeterie($this);
        }

        return $this;
    }

    public function removePapeterie(CompteGL1 $papeterie): self
    {
        if ($this->Papeterie->removeElement($papeterie)) {
            // set the owning side to null (unless already changed)
            if ($papeterie->getPapeterie() === $this) {
                $papeterie->setPapeterie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCommission(): Collection
    {
        return $this->Commission;
    }

    public function addCommission(CompteGL1 $commission): self
    {
        if (!$this->Commission->contains($commission)) {
            $this->Commission[] = $commission;
            $commission->setCommission($this);
        }

        return $this;
    }

    public function removeCommission(CompteGL1 $commission): self
    {
        if ($this->Commission->removeElement($commission)) {
            // set the owning side to null (unless already changed)
            if ($commission->getCommission() === $this) {
                $commission->setCommission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getFraisDeveloppement(): Collection
    {
        return $this->FraisDeveloppement;
    }

    public function addFraisDeveloppement(CompteGL1 $fraisDeveloppement): self
    {
        if (!$this->FraisDeveloppement->contains($fraisDeveloppement)) {
            $this->FraisDeveloppement[] = $fraisDeveloppement;
            $fraisDeveloppement->setFraisDeveloppement($this);
        }

        return $this;
    }

    public function removeFraisDeveloppement(CompteGL1 $fraisDeveloppement): self
    {
        if ($this->FraisDeveloppement->removeElement($fraisDeveloppement)) {
            // set the owning side to null (unless already changed)
            if ($fraisDeveloppement->getFraisDeveloppement() === $this) {
                $fraisDeveloppement->setFraisDeveloppement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getFraisRefinancement(): Collection
    {
        return $this->FraisRefinancement;
    }

    public function addFraisRefinancement(CompteGL1 $fraisRefinancement): self
    {
        if (!$this->FraisRefinancement->contains($fraisRefinancement)) {
            $this->FraisRefinancement[] = $fraisRefinancement;
            $fraisRefinancement->setFraisRefinancement($this);
        }

        return $this;
    }

    public function removeFraisRefinancement(CompteGL1 $fraisRefinancement): self
    {
        if ($this->FraisRefinancement->removeElement($fraisRefinancement)) {
            // set the owning side to null (unless already changed)
            if ($fraisRefinancement->getFraisRefinancement() === $this) {
                $fraisRefinancement->setFraisRefinancement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getPapeterieDecaissement(): Collection
    {
        return $this->PapeterieDecaissement;
    }

    public function addPapeterieDecaissement(CompteGL1 $papeterieDecaissement): self
    {
        if (!$this->PapeterieDecaissement->contains($papeterieDecaissement)) {
            $this->PapeterieDecaissement[] = $papeterieDecaissement;
            $papeterieDecaissement->setPapeterieDecaissement($this);
        }

        return $this;
    }

    public function removePapeterieDecaissement(CompteGL1 $papeterieDecaissement): self
    {
        if ($this->PapeterieDecaissement->removeElement($papeterieDecaissement)) {
            // set the owning side to null (unless already changed)
            if ($papeterieDecaissement->getPapeterieDecaissement() === $this) {
                $papeterieDecaissement->setPapeterieDecaissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getCommisssionDecaissement(): Collection
    {
        return $this->CommisssionDecaissement;
    }

    public function addCommisssionDecaissement(CompteGL1 $commisssionDecaissement): self
    {
        if (!$this->CommisssionDecaissement->contains($commisssionDecaissement)) {
            $this->CommisssionDecaissement[] = $commisssionDecaissement;
            $commisssionDecaissement->setCommisssionDecaissement($this);
        }

        return $this;
    }

    public function removeCommisssionDecaissement(CompteGL1 $commisssionDecaissement): self
    {
        if ($this->CommisssionDecaissement->removeElement($commisssionDecaissement)) {
            // set the owning side to null (unless already changed)
            if ($commisssionDecaissement->getCommisssionDecaissement() === $this) {
                $commisssionDecaissement->setCommisssionDecaissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteGL1>
     */
    public function getFraisDvlppmntDecaissement(): Collection
    {
        return $this->FraisDvlppmntDecaissement;
    }

    public function addFraisDvlppmntDecaissement(CompteGL1 $fraisDvlppmntDecaissement): self
    {
        if (!$this->FraisDvlppmntDecaissement->contains($fraisDvlppmntDecaissement)) {
            $this->FraisDvlppmntDecaissement[] = $fraisDvlppmntDecaissement;
            $fraisDvlppmntDecaissement->setFraisDvlppmntDecaissement($this);
        }

        return $this;
    }

    public function removeFraisDvlppmntDecaissement(CompteGL1 $fraisDvlppmntDecaissement): self
    {
        if ($this->FraisDvlppmntDecaissement->removeElement($fraisDvlppmntDecaissement)) {
            // set the owning side to null (unless already changed)
            if ($fraisDvlppmntDecaissement->getFraisDvlppmntDecaissement() === $this) {
                $fraisDvlppmntDecaissement->setFraisDvlppmntDecaissement(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getId();
    }
}
