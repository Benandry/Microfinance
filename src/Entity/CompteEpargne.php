<?php

namespace App\Entity;

use App\Repository\CompteEpargneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteEpargneRepository::class)]
class CompteEpargne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'produitcompteepargne')]
    private ?ProduitEpargne $produit = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedebut = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $codeep = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $codeepargne = null;

    #[ORM\Column(length: 255)]
    private ?string $typeClient = null;

    #[ORM\Column(nullable: true)]
    private ?bool $activated = null;

    #[ORM\ManyToOne(inversedBy: 'compteEpargnes')]
    private ?Individuelclient $individuelclient = null;

    #[ORM\ManyToOne(inversedBy: 'compteEpargnes')]
    private ?Groupe $groupe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?ProduitEpargne
    {
        return $this->produit;
    }

    public function setProduit(?ProduitEpargne $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

 

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function getCodeep(): ?string
    {
        return $this->codeep;
    }

    public function setCodeep(?string $codeep): self
    {
        $this->codeep = $codeep;

        return $this;
    }

    public function getCodeepargne(): ?string
    {
        return $this->codeepargne;
    }

    public function setCodeepargne(?string $codeepargne): self
    {
        $this->codeepargne = $codeepargne;

        return $this;
    }

    public function getTypeClient(): ?string
    {
        return $this->typeClient;
    }

    public function setTypeClient(string $typeClient): self
    {
        $this->typeClient = $typeClient;

        return $this;
    }

    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(?bool $activated): self
    {
        $this->activated = $activated;

        return $this;
    }

    public function getIndividuelclient(): ?Individuelclient
    {
        return $this->individuelclient;
    }

    public function setIndividuelclient(?Individuelclient $individuelclient): self
    {
        $this->individuelclient = $individuelclient;

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }
}
