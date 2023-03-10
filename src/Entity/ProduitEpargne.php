<?php

namespace App\Entity;

use App\Repository\ProduitEpargneRepository;
use App\Entity\ConfigEp;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitEpargneRepository::class)]
class ProduitEpargne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomproduit = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: CompteEpargne::class)]
    private Collection $produitcompteepargne;


    #[ORM\OneToMany(mappedBy: 'produitEpargne', targetEntity: ConfigEp::class)]
    private Collection $ConfigProduit;

    #[ORM\OneToMany(mappedBy: 'ProduitEpargne', targetEntity: DemandeCredit::class)]
    private Collection $demandeCredits;

    #[ORM\OneToMany(mappedBy: 'ProduitEpargne', targetEntity: GarantieCredit::class)]
    private Collection $garantieCredits;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $abbreviation = null;


    public function __construct()
    {
        $this->produitcompteepargne = new ArrayCollection();
        $this->ConfigProduit = new ArrayCollection();
        $this->demandeCredits = new ArrayCollection();
        $this->garantieCredits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomproduit(): ?string
    {
        return $this->nomproduit;
    }

    public function setNomproduit(string $nomproduit): self
    {
        $this->nomproduit = $nomproduit;

        return $this;
    }


    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return Collection<int, CompteEpargne>
     */
    public function getProduitcompteepargne(): Collection
    {
        return $this->produitcompteepargne;
    }

    public function addProduitcompteepargne(CompteEpargne $produitcompteepargne): self
    {
        if (!$this->produitcompteepargne->contains($produitcompteepargne)) {
            $this->produitcompteepargne[] = $produitcompteepargne;
            $produitcompteepargne->setProduit($this);
        }

        return $this;
    }

    public function removeProduitcompteepargne(CompteEpargne $produitcompteepargne): self
    {
        if ($this->produitcompteepargne->removeElement($produitcompteepargne)) {
            // set the owning side to null (unless already changed)
            if ($produitcompteepargne->getProduit() === $this) {
                $produitcompteepargne->setProduit(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection<int, ConfigEp>
     */
    public function getConfigProduit(): Collection
    {
        return $this->ConfigProduit;
    }

    public function addConfigProduit(ConfigEp $configProduit): self
    {
        if (!$this->ConfigProduit->contains($configProduit)) {
            $this->ConfigProduit[] = $configProduit;
            $configProduit->setProduitEpargne($this);
        }

        return $this;
    }

    public function removeConfigProduit(ConfigEp $configProduit): self
    {
        if ($this->ConfigProduit->removeElement($configProduit)) {
            // set the owning side to null (unless already changed)
            if ($configProduit->getProduitEpargne() === $this) {
                $configProduit->setProduitEpargne(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection<int, Produittransfert>
    //  */
    // public function getProduitepargne1(): Collection
    // {
    //     return $this->produitepargne1;
    // }

    // public function addProduitepargne1(Produittransfert $produitepargne1): self
    // {
    //     if (!$this->produitepargne1->contains($produitepargne1)) {
    //         $this->produitepargne1[] = $produitepargne1;
    //         $produitepargne1->setProduit1($this);
    //     }

    //     return $this;
    // }

    // public function removeProduitepargne1(Produittransfert $produitepargne1): self
    // {
    //     if ($this->produitepargne1->removeElement($produitepargne1)) {
    //         // set the owning side to null (unless already changed)
    //         if ($produitepargne1->getProduit1() === $this) {
    //             $produitepargne1->setProduit1(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Produittransfert>
    //  */
    // public function getProduitepargne2(): Collection
    // {
    //     return $this->produitepargne2;
    // }

    // public function addProduitepargne2(Produittransfert $produitepargne2): self
    // {
    //     if (!$this->produitepargne2->contains($produitepargne2)) {
    //         $this->produitepargne2[] = $produitepargne2;
    //         $produitepargne2->setProduitEpargne2($this);
    //     }

    //     return $this;
    // }

    // public function removeProduitepargne2(Produittransfert $produitepargne2): self
    // {
    //     if ($this->produitepargne2->removeElement($produitepargne2)) {
    //         // set the owning side to null (unless already changed)
    //         if ($produitepargne2->getProduitEpargne2() === $this) {
    //             $produitepargne2->setProduitEpargne2(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, DemandeCredit>
     */
    public function getDemandeCredits(): Collection
    {
        return $this->demandeCredits;
    }

    // public function addDemandeCredit(DemandeCredit $demandeCredit): self
    // {
    //     if (!$this->demandeCredits->contains($demandeCredit)) {
    //         $this->demandeCredits[] = $demandeCredit;
    //         $demandeCredit->setProduitEpargne($this);
    //     }

    //     return $this;
    // }

    // public function removeDemandeCredit(DemandeCredit $demandeCredit): self
    // {
    //     if ($this->demandeCredits->removeElement($demandeCredit)) {
    //         // set the owning side to null (unless already changed)
    //         if ($demandeCredit->getProduitEpargne() === $this) {
    //             $demandeCredit->setProduitEpargne(null);
    //         }
    //     }

    //     return $this;
    // }

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
            $garantieCredit->setProduitEpargne($this);
        }

        return $this;
    }

    public function removeGarantieCredit(GarantieCredit $garantieCredit): self
    {
        if ($this->garantieCredits->removeElement($garantieCredit)) {
            // set the owning side to null (unless already changed)
            if ($garantieCredit->getProduitEpargne() === $this) {
                $garantieCredit->setProduitEpargne(null);
            }
        }

        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(?string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

}
