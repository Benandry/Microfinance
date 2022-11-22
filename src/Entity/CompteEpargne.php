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

    #[ORM\OneToMany(mappedBy: 'produitatransferer', targetEntity: TransfertProduit::class)]
    private Collection $transfertProduits;

    #[ORM\OneToMany(mappedBy: 'Produittransmis', targetEntity: TransfertProduit::class)]
    private Collection $produittransmis;

    #[ORM\OneToMany(mappedBy: 'compte', targetEntity: TransfertProduit::class)]
    private Collection $compteTransfert;

    #[ORM\OneToMany(mappedBy: 'compte1', targetEntity: Produittransfert::class)]
    private Collection $comptetransfert1;

    #[ORM\OneToMany(mappedBy: 'compte2', targetEntity: Produittransfert::class)]
    private Collection $comptetransfert2;

    #[ORM\Column(length: 50)]
    private ?string $typeClient = null;

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

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $codegroupe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codegroupeepargne = null;

    
    public function __construct()
    {
        $this->compteep = new ArrayCollection();
        $this->transfertProduits = new ArrayCollection();
        $this->produittransmis = new ArrayCollection();
        $this->compteTransfert = new ArrayCollection();
        $this->comptetransfert1 = new ArrayCollection();
        $this->comptetransfert2 = new ArrayCollection();
        $this->individuelclients = new ArrayCollection();
        $this->CodeIndividuelClient = new ArrayCollection();
        $this->codeindcl = new ArrayCollection();
        $this->transferts = new ArrayCollection();
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
     * @return Collection<int, TransfertProduit>
     */
    public function getTransfertProduits(): Collection
    {
        return $this->transfertProduits;
    }

    public function addTransfertProduit(TransfertProduit $transfertProduit): self
    {
        if (!$this->transfertProduits->contains($transfertProduit)) {
            $this->transfertProduits[] = $transfertProduit;
            $transfertProduit->setProduitatransferer($this);
        }

        return $this;
    }

    public function removeTransfertProduit(TransfertProduit $transfertProduit): self
    {
        if ($this->transfertProduits->removeElement($transfertProduit)) {
            // set the owning side to null (unless already changed)
            if ($transfertProduit->getProduitatransferer() === $this) {
                $transfertProduit->setProduitatransferer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TransfertProduit>
     */
    public function getProduittransmis(): Collection
    {
        return $this->produittransmis;
    }

    public function addProduittransmi(TransfertProduit $produittransmi): self
    {
        if (!$this->produittransmis->contains($produittransmi)) {
            $this->produittransmis[] = $produittransmi;
            $produittransmi->setProduittransmis($this);
        }

        return $this;
    }

    public function removeProduittransmi(TransfertProduit $produittransmi): self
    {
        if ($this->produittransmis->removeElement($produittransmi)) {
            // set the owning side to null (unless already changed)
            if ($produittransmi->getProduittransmis() === $this) {
                $produittransmi->setProduittransmis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TransfertProduit>
     */
    public function getCompteTransfert(): Collection
    {
        return $this->compteTransfert;
    }

    public function addCompteTransfert(TransfertProduit $compteTransfert): self
    {
        if (!$this->compteTransfert->contains($compteTransfert)) {
            $this->compteTransfert[] = $compteTransfert;
            $compteTransfert->setCompte($this);
        }

        return $this;
    }

    public function removeCompteTransfert(TransfertProduit $compteTransfert): self
    {
        if ($this->compteTransfert->removeElement($compteTransfert)) {
            // set the owning side to null (unless already changed)
            if ($compteTransfert->getCompte() === $this) {
                $compteTransfert->setCompte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Produittransfert>
     */
    public function getComptetransfert1(): Collection
    {
        return $this->comptetransfert1;
    }

    public function addComptetransfert1(Produittransfert $comptetransfert1): self
    {
        if (!$this->comptetransfert1->contains($comptetransfert1)) {
            $this->comptetransfert1[] = $comptetransfert1;
            $comptetransfert1->setCompte1($this);
        }

        return $this;
    }

    public function removeComptetransfert1(Produittransfert $comptetransfert1): self
    {
        if ($this->comptetransfert1->removeElement($comptetransfert1)) {
            // set the owning side to null (unless already changed)
            if ($comptetransfert1->getCompte1() === $this) {
                $comptetransfert1->setCompte1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Produittransfert>
     */
    public function getComptetransfert2(): Collection
    {
        return $this->comptetransfert2;
    }

    public function addComptetransfert2(Produittransfert $comptetransfert2): self
    {
        if (!$this->comptetransfert2->contains($comptetransfert2)) {
            $this->comptetransfert2[] = $comptetransfert2;
            $comptetransfert2->setCompte2($this);
        }

        return $this;
    }

    public function removeComptetransfert2(Produittransfert $comptetransfert2): self
    {
        if ($this->comptetransfert2->removeElement($comptetransfert2)) {
            // set the owning side to null (unless already changed)
            if ($comptetransfert2->getCompte2() === $this) {
                $comptetransfert2->setCompte2(null);
            }
        }

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

    public function getCodegroupe(): ?string
    {
        return $this->codegroupe;
    }

    public function setCodegroupe(string $codegroupe): self
    {
        $this->codegroupe = $codegroupe;

        return $this;
    }

    public function getCodegroupeepargne(): ?string
    {
        return $this->codegroupeepargne;
    }

    public function setCodegroupeepargne(?string $codegroupeepargne): self
    {
        $this->codegroupeepargne = $codegroupeepargne;

        return $this;
    }

}
