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

    #[ORM\ManyToOne(inversedBy: 'codecompteepargne')]
    private ?Individuelclient $codeclient = null;

    #[ORM\ManyToOne(inversedBy: 'produitcompteepargne')]
    private ?ProduitEpargne $produit = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedebut = null;

    #[ORM\ManyToMany(targetEntity: Individuelclient::class, mappedBy: 'CodeIndividuel')]
    private Collection $individuelclients;

    #[ORM\ManyToMany(targetEntity: Individuelclient::class, mappedBy: 'codeclientindividuel')]
    private Collection $CodeIndividuelClient;

    #[ORM\ManyToMany(targetEntity: Individuelclient::class, mappedBy: 'codeclientind')]
    private Collection $codeindcl;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $codeep = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $codeepargne = null;

    #[ORM\Column(length: 255)]
    private ?string $typeClient = null;
    
    public function __construct()
    {
        $this->individuelclients = new ArrayCollection();
        $this->CodeIndividuelClient = new ArrayCollection();
        $this->codeindcl = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeclient(): ?Individuelclient
    {
        return $this->codeclient;
    }

    public function setCodeclient(?Individuelclient $codeclient): self
    {
        $this->codeclient = $codeclient;

        return $this;
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

    /**
     * @return Collection<int, Individuelclient>
     */
    public function getIndividuelclients(): Collection
    {
        return $this->individuelclients;
    }
    /**
     * @return Collection<int, Individuelclient>
     */
    public function getCodeIndividuelClient(): Collection
    {
        return $this->CodeIndividuelClient;
    }

    /**
     * @return Collection<int, Individuelclient>
     */
    public function getCodeindcl(): Collection
    {
        return $this->codeindcl;
    }

    public function addCodeindcl(Individuelclient $codeindcl): self
    {
        if (!$this->codeindcl->contains($codeindcl)) {
            $this->codeindcl[] = $codeindcl;
            $codeindcl->addCodeclientind($this);
        }

        return $this;
    }

    public function removeCodeindcl(Individuelclient $codeindcl): self
    {
        if ($this->codeindcl->removeElement($codeindcl)) {
            $codeindcl->removeCodeclientind($this);
        }

        return $this;
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
}
