<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero_classe = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $labelle = null;

    #[ORM\OneToMany(mappedBy: 'classes', targetEntity: PlanComptable::class)]
    private Collection $planComptables;


    public function __construct()
    {
        $this->planComptables = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getLabelle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroClasse(): ?int
    {
        return $this->numero_classe;
    }

    public function setNumeroClasse(int $numero_classe): self
    {
        $this->numero_classe = $numero_classe;

        return $this;
    }

    public function getLabelle(): ?string
    {
        return $this->labelle;
    }

    public function setLabelle(string $labelle): self
    {
        $this->labelle = $labelle;

        return $this;
    }

    /**
     * @return Collection<int, PlanComptable>
     */
    public function getPlanComptables(): Collection
    {
        return $this->planComptables;
    }

    public function addPlanComptable(PlanComptable $planComptable): self
    {
        if (!$this->planComptables->contains($planComptable)) {
            $this->planComptables->add($planComptable);
            $planComptable->setClasses($this);
        }

        return $this;
    }

    public function removePlanComptable(PlanComptable $planComptable): self
    {
        if ($this->planComptables->removeElement($planComptable)) {
            // set the owning side to null (unless already changed)
            if ($planComptable->getClasses() === $this) {
                $planComptable->setClasses(null);
            }
        }

        return $this;
    }
}
