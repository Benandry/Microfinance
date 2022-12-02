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

    public function __construct()
    {
        $this->configurationGeneralCredits = new ArrayCollection();
        $this->creditIndividuels = new ArrayCollection();
        $this->demandeCredits = new ArrayCollection();
        $this->fraisConfigCredits = new ArrayCollection();
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
}
