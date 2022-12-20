<?php

namespace App\Entity;

use App\Repository\ProduitCreditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitCreditRepository::class)]
class ProduitCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomProduitCredit = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: ConfigurationGeneralCredit::class)]
    private Collection $configurationGeneralCredits;

    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: CreditIndividuel::class)]
    private Collection $creditIndividuels;

    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: DemandeCredit::class)]
    private Collection $demandeCredits;

    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: FraisConfigCredit::class)]
    private Collection $fraisConfigCredits;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'produitCredits')]
    private ?self $ProduitCredit = null;

    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: self::class)]
    private Collection $produitCredits;

    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: GarantieCredit::class)]
    private Collection $garantieCredits;

    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: CompteGL1::class)]
    private Collection $compteGL1s;

    public function __construct()
    {
        $this->configurationGeneralCredits = new ArrayCollection();
        $this->creditIndividuels = new ArrayCollection();
        $this->demandeCredits = new ArrayCollection();
        $this->fraisConfigCredits = new ArrayCollection();
        $this->produitCredits = new ArrayCollection();
        $this->garantieCredits = new ArrayCollection();
        $this->compteGL1s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduitCredit(): ?string
    {
        return $this->NomProduitCredit;
    }

    public function setNomProduitCredit(string $NomProduitCredit): self
    {
        $this->NomProduitCredit = $NomProduitCredit;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, ConfigurationGeneralCredit>
     */
    public function getConfigurationGeneralCredits(): Collection
    {
        return $this->configurationGeneralCredits;
    }

    public function addConfigurationGeneralCredit(ConfigurationGeneralCredit $configurationGeneralCredit): self
    {
        if (!$this->configurationGeneralCredits->contains($configurationGeneralCredit)) {
            $this->configurationGeneralCredits[] = $configurationGeneralCredit;
            $configurationGeneralCredit->setProduitCredit($this);
        }

        return $this;
    }

    public function removeConfigurationGeneralCredit(ConfigurationGeneralCredit $configurationGeneralCredit): self
    {
        if ($this->configurationGeneralCredits->removeElement($configurationGeneralCredit)) {
            // set the owning side to null (unless already changed)
            if ($configurationGeneralCredit->getProduitCredit() === $this) {
                $configurationGeneralCredit->setProduitCredit(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getId();
    }

    /**
     * @return Collection<int, CreditIndividuel>
     */
    public function getCreditIndividuels(): Collection
    {
        return $this->creditIndividuels;
    }

    public function addCreditIndividuel(CreditIndividuel $creditIndividuel): self
    {
        if (!$this->creditIndividuels->contains($creditIndividuel)) {
            $this->creditIndividuels[] = $creditIndividuel;
            $creditIndividuel->setProduitCredit($this);
        }

        return $this;
    }

    public function removeCreditIndividuel(CreditIndividuel $creditIndividuel): self
    {
        if ($this->creditIndividuels->removeElement($creditIndividuel)) {
            // set the owning side to null (unless already changed)
            if ($creditIndividuel->getProduitCredit() === $this) {
                $creditIndividuel->setProduitCredit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DemandeCredit>
     */
    public function getDemandeCredits(): Collection
    {
        return $this->demandeCredits;
    }

    public function addDemandeCredit(DemandeCredit $demandeCredit): self
    {
        if (!$this->demandeCredits->contains($demandeCredit)) {
            $this->demandeCredits[] = $demandeCredit;
            $demandeCredit->setProduitCredit($this);
        }

        return $this;
    }

    public function removeDemandeCredit(DemandeCredit $demandeCredit): self
    {
        if ($this->demandeCredits->removeElement($demandeCredit)) {
            // set the owning side to null (unless already changed)
            if ($demandeCredit->getProduitCredit() === $this) {
                $demandeCredit->setProduitCredit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FraisConfigCredit>
     */
    public function getFraisConfigCredits(): Collection
    {
        return $this->fraisConfigCredits;
    }

    public function addFraisConfigCredit(FraisConfigCredit $fraisConfigCredit): self
    {
        if (!$this->fraisConfigCredits->contains($fraisConfigCredit)) {
            $this->fraisConfigCredits[] = $fraisConfigCredit;
            $fraisConfigCredit->setProduitCredit($this);
        }

        return $this;
    }

    public function removeFraisConfigCredit(FraisConfigCredit $fraisConfigCredit): self
    {
        if ($this->fraisConfigCredits->removeElement($fraisConfigCredit)) {
            // set the owning side to null (unless already changed)
            if ($fraisConfigCredit->getProduitCredit() === $this) {
                $fraisConfigCredit->setProduitCredit(null);
            }
        }

        return $this;
    }

    public function getProduitCredit(): ?self
    {
        return $this->ProduitCredit;
    }

    public function setProduitCredit(?self $ProduitCredit): self
    {
        $this->ProduitCredit = $ProduitCredit;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getProduitCredits(): Collection
    {
        return $this->produitCredits;
    }

    public function addProduitCredit(self $produitCredit): self
    {
        if (!$this->produitCredits->contains($produitCredit)) {
            $this->produitCredits[] = $produitCredit;
            $produitCredit->setProduitCredit($this);
        }

        return $this;
    }

    public function removeProduitCredit(self $produitCredit): self
    {
        if ($this->produitCredits->removeElement($produitCredit)) {
            // set the owning side to null (unless already changed)
            if ($produitCredit->getProduitCredit() === $this) {
                $produitCredit->setProduitCredit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GarantieCredit>
     */
    public function getGarantieCredits(): Collection
    {
        return $this->garantieCredits;
    }

    public function addGarantieCredit(GarantieCredit $garantieCredit): self
    {
        if (!$this->garantieCredits->contains($garantieCredit)) {
            $this->garantieCredits[] = $garantieCredit;
            $garantieCredit->setProduitCredit($this);
        }

        return $this;
    }

    public function removeGarantieCredit(GarantieCredit $garantieCredit): self
    {
        if ($this->garantieCredits->removeElement($garantieCredit)) {
            // set the owning side to null (unless already changed)
            if ($garantieCredit->getProduitCredit() === $this) {
                $garantieCredit->setProduitCredit(null);
            }
        }

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
            $compteGL1->setProduitCredit($this);
        }

        return $this;
    }

    public function removeCompteGL1(CompteGL1 $compteGL1): self
    {
        if ($this->compteGL1s->removeElement($compteGL1)) {
            // set the owning side to null (unless already changed)
            if ($compteGL1->getProduitCredit() === $this) {
                $compteGL1->setProduitCredit(null);
            }
        }

        return $this;
    }
}
