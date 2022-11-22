<?php

namespace App\Entity;

use App\Repository\TitreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TitreRepository::class)]
class Titre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\OneToMany(mappedBy: 'titre', targetEntity: Individuelclient::class)]
    private Collection $titreInd;

    public function __construct()
    {
        $this->titreInd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Individuelclient>
     */
    public function getTitreInd(): Collection
    {
        return $this->titreInd;
    }

    public function addTitreInd(Individuelclient $titreInd): self
    {
        if (!$this->titreInd->contains($titreInd)) {
            $this->titreInd[] = $titreInd;
            $titreInd->setTitre($this);
        }

        return $this;
    }

    public function removeTitreInd(Individuelclient $titreInd): self
    {
        if ($this->titreInd->removeElement($titreInd)) {
            // set the owning side to null (unless already changed)
            if ($titreInd->getTitre() === $this) {
                $titreInd->setTitre(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}
