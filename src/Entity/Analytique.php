<?php

namespace App\Entity;

use App\Repository\AnalytiqueRepository;
<<<<<<< HEAD
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
=======
>>>>>>> refs/remotes/origin/main
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalytiqueRepository::class)]
class Analytique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $percent = null;

<<<<<<< HEAD
    #[ORM\OneToMany(mappedBy: 'analytique', targetEntity: MouvementComptable::class)]
    private Collection $mouvementComptables;

    public function __construct()
    {
        $this->mouvementComptables = new ArrayCollection();
    }

=======
>>>>>>> refs/remotes/origin/main
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPercent(): ?string
    {
        return $this->percent;
    }

    public function setPercent(string $percent): self
    {
        $this->percent = $percent;

        return $this;
    }
<<<<<<< HEAD

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
            $mouvementComptable->setAnalytique($this);
        }

        return $this;
    }

    public function removeMouvementComptable(MouvementComptable $mouvementComptable): self
    {
        if ($this->mouvementComptables->removeElement($mouvementComptable)) {
            // set the owning side to null (unless already changed)
            if ($mouvementComptable->getAnalytique() === $this) {
                $mouvementComptable->setAnalytique(null);
            }
        }

        return $this;
    }
=======
>>>>>>> refs/remotes/origin/main
}
