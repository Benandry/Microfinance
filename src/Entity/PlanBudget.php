<?php

namespace App\Entity;

use App\Repository\PlanBudgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanBudgetRepository::class)]
class PlanBudget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $montant = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeBudget = null;

    #[ORM\OneToMany(mappedBy: 'budgetaire', targetEntity: MouvementComptable::class)]
    private Collection $mouvementComptables;

    public function __construct()
    {
        $this->mouvementComptables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getTypeBudget(): ?string
    {
        return $this->TypeBudget;
    }

    public function setTypeBudget(string $TypeBudget): self
    {
        $this->TypeBudget = $TypeBudget;

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
            $mouvementComptable->setBudgetaire($this);
        }

        return $this;
    }

    public function removeMouvementComptable(MouvementComptable $mouvementComptable): self
    {
        if ($this->mouvementComptables->removeElement($mouvementComptable)) {
            // set the owning side to null (unless already changed)
            if ($mouvementComptable->getBudgetaire() === $this) {
                $mouvementComptable->setBudgetaire(null);
            }
        }

        return $this;
    }
}
