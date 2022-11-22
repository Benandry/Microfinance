<?php

namespace App\Entity;

use App\Repository\EtatcivileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatcivileRepository::class)]
class Etatcivile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $etatcivile = null;

    #[ORM\OneToMany(mappedBy: 'etatcivile', targetEntity: Individuelclient::class)]
    private Collection $etatcivileind;

    public function __construct()
    {
        $this->etatcivileind = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatcivile(): ?string
    {
        return $this->etatcivile;
    }

    public function setEtatcivile(string $etatcivile): self
    {
        $this->etatcivile = $etatcivile;

        return $this;
    }

    /**
     * @return Collection<int, Individuelclient>
     */
    public function getEtatcivileind(): Collection
    {
        return $this->etatcivileind;
    }

    public function addEtatcivileind(Individuelclient $etatcivileind): self
    {
        if (!$this->etatcivileind->contains($etatcivileind)) {
            $this->etatcivileind[] = $etatcivileind;
            $etatcivileind->setEtatcivile($this);
        }

        return $this;
    }

    public function removeEtatcivileind(Individuelclient $etatcivileind): self
    {
        if ($this->etatcivileind->removeElement($etatcivileind)) {
            // set the owning side to null (unless already changed)
            if ($etatcivileind->getEtatcivile() === $this) {
                $etatcivileind->setEtatcivile(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}
