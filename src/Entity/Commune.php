<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomCommune = null;

    #[ORM\Column(length: 255)]
    private ?string $CodeCommune = null;

    #[ORM\OneToMany(mappedBy: 'commune', targetEntity: Individuelclient::class)]
    private Collection $individuelclients;


    public function __construct()
    {
        $this->Codecomm = new ArrayCollection();
        $this->individuelclients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCommune(): ?string
    {
        return $this->NomCommune;
    }

    public function setNomCommune(string $NomCommune): self
    {
        $this->NomCommune = $NomCommune;

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->CodeCommune;
    }

    public function setCodeCommune(string $CodeCommune): self
    {
        $this->CodeCommune = $CodeCommune;

        return $this;
    }

        public function __toString()
    {
        return (string) $this->getId();
    }

        /**
         * @return Collection<int, Individuelclient>
         */
        public function getIndividuelclients(): Collection
        {
            return $this->individuelclients;
        }

        public function addIndividuelclient(Individuelclient $individuelclient): self
        {
            if (!$this->individuelclients->contains($individuelclient)) {
                $this->individuelclients[] = $individuelclient;
                $individuelclient->setCommune($this);
            }

            return $this;
        }

        public function removeIndividuelclient(Individuelclient $individuelclient): self
        {
            if ($this->individuelclients->removeElement($individuelclient)) {
                // set the owning side to null (unless already changed)
                if ($individuelclient->getCommune() === $this) {
                    $individuelclient->setCommune(null);
                }
            }

            return $this;
        }
}
