<?php

namespace App\Entity;

use App\Repository\EtudeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudeRepository::class)]
class Etude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau = null;

    #[ORM\OneToMany(mappedBy: 'etude', targetEntity: Individuelclient::class)]
    private Collection $EtudeInd;

    public function __construct()
    {
        $this->EtudeInd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return Collection<int, Individuelclient>
     */
    public function getEtudeInd(): Collection
    {
        return $this->EtudeInd;
    }

    public function addEtudeInd(Individuelclient $etudeInd): self
    {
        if (!$this->EtudeInd->contains($etudeInd)) {
            $this->EtudeInd[] = $etudeInd;
            $etudeInd->setEtude($this);
        }

        return $this;
    }

    public function removeEtudeInd(Individuelclient $etudeInd): self
    {
        if ($this->EtudeInd->removeElement($etudeInd)) {
            // set the owning side to null (unless already changed)
            if ($etudeInd->getEtude() === $this) {
                $etudeInd->setEtude(null);
            }
        }

        return $this;
    }
}
