<?php

namespace App\Entity;

use App\Repository\DepotAtermeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepotAtermeRepository::class)]
class DepotAterme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'NumCompte')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Individuelclient $compte = null;

    #[ORM\ManyToOne(inversedBy: 'peoduitep')]
    private ?ProduitEpargne $produit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datedepot = null;

    #[ORM\Column(length: 20)]
    private ?string $piececomptable = null;

    #[ORM\Column]
    private ?float $tauxinteret = null;

    #[ORM\Column]
    private ?int $periodemois = null;

    #[ORM\Column]
    private ?bool $is_interetcapitalise = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_echeance = null;

    #[ORM\Column]
    private ?float $valeurecheance = null;

    #[ORM\Column]
    private ?float $taxeretenue = null;

    #[ORM\Column]
    private ?float $retenuetaxe = null;

    #[ORM\Column]
    private ?float $TVA = null;

    #[ORM\Column]
    private ?bool $is_depotcall = null;

    #[ORM\Column]
    private ?bool $is_interetecheance = null;

    #[ORM\Column]
    private ?bool $is_interetmois = null;

    #[ORM\Column]
    private ?bool $is_interettrimestrielle = null;

    #[ORM\Column]
    private ?bool $is_interetsemestrielle = null;

    #[ORM\Column]
    private ?bool $is_interetpayelorscalcul = null;

    #[ORM\Column]
    private ?bool $_is_interettransferercptep = null;

    #[ORM\Column]
    private ?bool $is_retirealecheance = null;

    #[ORM\Column]
    private ?bool $is_remetreaucptalecheance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompte(): ?Individuelclient
    {
        return $this->compte;
    }

    public function setCompte(?Individuelclient $compte): self
    {
        $this->compte = $compte;

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

    public function getDatedepot(): ?\DateTimeInterface
    {
        return $this->datedepot;
    }

    public function setDatedepot(\DateTimeInterface $datedepot): self
    {
        $this->datedepot = $datedepot;

        return $this;
    }

    public function getPiececomptable(): ?string
    {
        return $this->piececomptable;
    }

    public function setPiececomptable(string $piececomptable): self
    {
        $this->piececomptable = $piececomptable;

        return $this;
    }

    public function getTauxinteret(): ?float
    {
        return $this->tauxinteret;
    }

    public function setTauxinteret(float $tauxinteret): self
    {
        $this->tauxinteret = $tauxinteret;

        return $this;
    }

    public function getPeriodemois(): ?int
    {
        return $this->periodemois;
    }

    public function setPeriodemois(int $periodemois): self
    {
        $this->periodemois = $periodemois;

        return $this;
    }

    public function isIsInteretcapitalise(): ?bool
    {
        return $this->is_interetcapitalise;
    }

    public function setIsInteretcapitalise(bool $is_interetcapitalise): self
    {
        $this->is_interetcapitalise = $is_interetcapitalise;

        return $this;
    }

    public function getDateEcheance(): ?\DateTimeInterface
    {
        return $this->date_echeance;
    }

    public function setDateEcheance(\DateTimeInterface $date_echeance): self
    {
        $this->date_echeance = $date_echeance;

        return $this;
    }

    public function getValeurecheance(): ?float
    {
        return $this->valeurecheance;
    }

    public function setValeurecheance(float $valeurecheance): self
    {
        $this->valeurecheance = $valeurecheance;

        return $this;
    }

    public function getTaxeretenue(): ?float
    {
        return $this->taxeretenue;
    }

    public function setTaxeretenue(float $taxeretenue): self
    {
        $this->taxeretenue = $taxeretenue;

        return $this;
    }

    public function getRetenuetaxe(): ?float
    {
        return $this->retenuetaxe;
    }

    public function setRetenuetaxe(float $retenuetaxe): self
    {
        $this->retenuetaxe = $retenuetaxe;

        return $this;
    }

    public function getTVA(): ?float
    {
        return $this->TVA;
    }

    public function setTVA(float $TVA): self
    {
        $this->TVA = $TVA;

        return $this;
    }

    public function isIsDepotcall(): ?bool
    {
        return $this->is_depotcall;
    }

    public function setIsDepotcall(bool $is_depotcall): self
    {
        $this->is_depotcall = $is_depotcall;

        return $this;
    }

    public function isIsInteretecheance(): ?bool
    {
        return $this->is_interetecheance;
    }

    public function setIsInteretecheance(bool $is_interetecheance): self
    {
        $this->is_interetecheance = $is_interetecheance;

        return $this;
    }

    public function isIsInteretmois(): ?bool
    {
        return $this->is_interetmois;
    }

    public function setIsInteretmois(bool $is_interetmois): self
    {
        $this->is_interetmois = $is_interetmois;

        return $this;
    }

    public function isIsInterettrimestrielle(): ?bool
    {
        return $this->is_interettrimestrielle;
    }

    public function setIsInterettrimestrielle(bool $is_interettrimestrielle): self
    {
        $this->is_interettrimestrielle = $is_interettrimestrielle;

        return $this;
    }

    public function isIsInteretsemestrielle(): ?bool
    {
        return $this->is_interetsemestrielle;
    }

    public function setIsInteretsemestrielle(bool $is_interetsemestrielle): self
    {
        $this->is_interetsemestrielle = $is_interetsemestrielle;

        return $this;
    }

    public function isIsInteretpayelorscalcul(): ?bool
    {
        return $this->is_interetpayelorscalcul;
    }

    public function setIsInteretpayelorscalcul(bool $is_interetpayelorscalcul): self
    {
        $this->is_interetpayelorscalcul = $is_interetpayelorscalcul;

        return $this;
    }

    public function isIsInterettransferercptep(): ?bool
    {
        return $this->_is_interettransferercptep;
    }

    public function setIsInterettransferercptep(bool $_is_interettransferercptep): self
    {
        $this->_is_interettransferercptep = $_is_interettransferercptep;

        return $this;
    }

    public function isIsRetirealecheance(): ?bool
    {
        return $this->is_retirealecheance;
    }

    public function setIsRetirealecheance(bool $is_retirealecheance): self
    {
        $this->is_retirealecheance = $is_retirealecheance;

        return $this;
    }

    public function isIsRemetreaucptalecheance(): ?bool
    {
        return $this->is_remetreaucptalecheance;
    }

    public function setIsRemetreaucptalecheance(bool $is_remetreaucptalecheance): self
    {
        $this->is_remetreaucptalecheance = $is_remetreaucptalecheance;

        return $this;
    }
}
