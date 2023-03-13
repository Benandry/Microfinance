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

    #[ORM\ManyToOne(inversedBy: 'planComptables')]
    private ?Classes $classes = null;

    #[ORM\OneToMany(mappedBy: 'planCompta', targetEntity: MouvementComptable::class)]
    private Collection $mouvementComptables;

    #[ORM\OneToMany(mappedBy: 'comptedebiteE', targetEntity: ConfigEp::class)]
    private Collection $configEps;

    #[ORM\OneToMany(mappedBy: 'compteCrediteE', targetEntity: ConfigEp::class)]
    private Collection $ConfiEpsCredit;

    public function __construct()
    {
        $this->mouvementComptables = new ArrayCollection();
        $this->configEps = new ArrayCollection();
        $this->ConfiEpsCredit = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->getId();
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

    public function getClasses(): ?Classes
    {
        return $this->classes;
    }

    public function setClasses(?Classes $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * @return Collection<int, MouvementComptable>
     */
    public function getMouvementComptables(): Collection
    {
        return $this->mouvementComptables;
    }

    public function addMouvementComptable(MouvementComptable $mouvementComptable): self
    {
        if (!$this->mouvementComptables->contains($mouvementComptable)) {
            $this->mouvementComptables->add($mouvementComptable);
            $mouvementComptable->setPlanCompta($this);
        }

        return $this;
    }

    public function removeMouvementComptable(MouvementComptable $mouvementComptable): self
    {
        if ($this->mouvementComptables->removeElement($mouvementComptable)) {
            // set the owning side to null (unless already changed)
            if ($mouvementComptable->getPlanCompta() === $this) {
                $mouvementComptable->setPlanCompta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ConfigEp>
     */
    public function getConfigEps(): Collection
    {
        return $this->configEps;
    }

    // public function addConfigEp(ConfigEp $configEp): self
    // {
    //     if (!$this->configEps->contains($configEp)) {
    //         $this->configEps->add($configEp);
    //         $configEp->setComptedebiteE($this);
    //     }

    //     return $this;
    // }

    // public function removeConfigEp(ConfigEp $configEp): self
    // {
    //     if ($this->configEps->removeElement($configEp)) {
    //         // set the owning side to null (unless already changed)
    //         if ($configEp->getComptedebiteE() === $this) {
    //             $configEp->setComptedebiteE(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, ConfigEp>
    //  */
    // public function getConfiEpsCredit(): Collection
    // {
    //     return $this->ConfiEpsCredit;
    // }

    // public function addConfiEpsCredit(ConfigEp $confiEpsCredit): self
    // {
    //     if (!$this->ConfiEpsCredit->contains($confiEpsCredit)) {
    //         $this->ConfiEpsCredit->add($confiEpsCredit);
    //         $confiEpsCredit->setCompteCrediteE($this);
    //     }

    //     return $this;
    // }

    // public function removeConfiEpsCredit(ConfigEp $confiEpsCredit): self
    // {
    //     if ($this->ConfiEpsCredit->removeElement($confiEpsCredit)) {
    //         // set the owning side to null (unless already changed)
    //         if ($confiEpsCredit->getCompteCrediteE() === $this) {
    //             $confiEpsCredit->setCompteCrediteE(null);
    //         }
    //     }

    //     return $this;
    // }
}
