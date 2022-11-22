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

    #[ORM\Column]
    private ?bool $isdesactive = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: DepotAterme::class)]
    private Collection $peoduitep;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: CompteEpargne::class)]
    private Collection $produitcompteepargne;

    #[ORM\ManyToOne(inversedBy: 'TypeProduit')]
    private ?TypeEpargne $typeEpargne = null;

    #[ORM\OneToMany(mappedBy: 'produitEpargne', targetEntity: ConfigEp::class)]
    private Collection $ConfigProduit;

    // #[ORM\OneToMany(mappedBy: 'Produit1', targetEntity: Produittransfert::class)]
    // private Collection $produitepargne1;

    // #[ORM\OneToMany(mappedBy: 'ProduitEpargne2', targetEntity: Produittransfert::class)]
    // private Collection $produitepargne2;

    public function __construct()
    {
        $this->peoduitep = new ArrayCollection();
        $this->produitcompteepargne = new ArrayCollection();
        $this->ConfigProduit = new ArrayCollection();
        $this->produitepargne1 = new ArrayCollection();
        $this->produitepargne2 = new ArrayCollection();
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

    public function isIsdesactive(): ?bool
    {
        return $this->isdesactive;
    }

    public function setIsdesactive(bool $isdesactive): self
    {
        $this->isdesactive = $isdesactive;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return Collection<int, DepotAterme>
     */
    public function getPeoduitep(): Collection
    {
        return $this->peoduitep;
    }

    public function addPeoduitep(DepotAterme $peoduitep): self
    {
        if (!$this->peoduitep->contains($peoduitep)) {
            $this->peoduitep[] = $peoduitep;
            $peoduitep->setProduit($this);
        }

        return $this;
    }

    public function removePeoduitep(DepotAterme $peoduitep): self
    {
        if ($this->peoduitep->removeElement($peoduitep)) {
            // set the owning side to null (unless already changed)
            if ($peoduitep->getProduit() === $this) {
                $peoduitep->setProduit(null);
            }
        }

        return $this;
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


    public function getTypeEpargne(): ?TypeEpargne
    {
        return $this->typeEpargne;
    }

    public function setTypeEpargne(?TypeEpargne $typeEpargne): self
    {
        $this->typeEpargne = $typeEpargne;

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

}
