<?php

namespace App\Entity;

use App\Repository\IndividuelclientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndividuelclientRepository::class)]
class Individuelclient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;


    #[ORM\Column(length: 100)]
    private ?string $nom_client = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom_client = null;

    #[ORM\Column(length: 100)]
    private ?string $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_conjoint = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_inscription = null;

    #[ORM\Column(length: 10)]
    private ?string $sexe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_mobile = null;

    #[ORM\Column(length: 255)]
    private ?string $profession = null;

    #[ORM\Column]
    private ?int $nb_enfant = null;

    #[ORM\Column]
    private ?int $nb_personne_charge = null;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $parent_nom = null;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $parent_adresse = null;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $photo = null;

    #[ORM\OneToMany(mappedBy: 'codeclient', targetEntity: ApprouverClient::class)]
    private Collection $CodeIndividuel;

    #[ORM\OneToMany(mappedBy: 'compte', targetEntity: DepotAterme::class)]
    private Collection $NumCompte;

    #[ORM\OneToMany(mappedBy: 'codeclient', targetEntity: CompteEpargne::class)]
    private Collection $codecompteepargne;

    #[ORM\ManyToOne(inversedBy: 'etatcivileind')]
    private ?Etatcivile $etatcivile = null;

    #[ORM\ManyToOne(inversedBy: 'EtudeInd')]
    private ?Etude $etude = null;

    #[ORM\ManyToOne(inversedBy: 'titreInd')]
    private ?Titre $titre = null;

    #[ORM\OneToMany(mappedBy: 'CodeClient', targetEntity: Mobile::class)]
    private Collection $mobiles;

    #[ORM\Column(length: 255)]
    private ?string $adressephysique = null;

    #[ORM\ManyToOne(inversedBy: 'IndividuelMembre')]
    private ?Groupe $MembreGroupe = null;

    #[ORM\Column(length: 255)]
    private ?string $TitreGroupe=null;

    #[ORM\Column(length: 255)]
    private ?string $lieudelivrance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datecin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateexpiration = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeIdentite = null;

    #[ORM\OneToMany(mappedBy: 'codeclient', targetEntity: ListeRouge::class)]
    private Collection $listeRouges;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateadhesion=null;

    #[ORM\ManyToMany(targetEntity: CompteEpargne::class, inversedBy: 'codeindcl')]
    private Collection $codeclientind;


    #[ORM\Column(length: 30, nullable: true)]
    private ?string $codeclient = null;

    #[ORM\ManyToOne(inversedBy: 'individuelclients')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $commune = null;

    #[ORM\ManyToOne(inversedBy: 'individuelclients')]
    private ?Agence $Agence = null;

    
    public function __construct()
    {
        $this->CodeIndividuel = new ArrayCollection();
        $this->codecompteepargne = new ArrayCollection();
        $this->CompteMembreIndividuel = new ArrayCollection();
        $this->mobiles = new ArrayCollection();
        $this->docIdentites = new ArrayCollection();
        $this->listeRouges = new ArrayCollection();
        $this->codeclientind = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nom_client;
    }

    public function setNomClient(string $nom_client): self
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenom_client;
    }

    public function setPrenomClient(string $prenom_client): self
    {
        $this->prenom_client = $prenom_client;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNomConjoint(): ?string
    {
        return $this->nom_conjoint;
    }

    public function setNomConjoint(string $nom_conjoint): self
    {
        $this->nom_conjoint = $nom_conjoint;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }


    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(string $lieu_naissance): self
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    public function getNumeroMobile(): ?string
    {
        return $this->numero_mobile;
    }

    public function setNumeroMobile(string $numero_mobile): self
    {
        $this->numero_mobile = $numero_mobile;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getNbEnfant(): ?int
    {
        return $this->nb_enfant;
    }

    public function setNbEnfant(int $nb_enfant): self
    {
        $this->nb_enfant = $nb_enfant;

        return $this;
    }

    public function getNbPersonneCharge(): ?int
    {
        return $this->nb_personne_charge;
    }

    public function setNbPersonneCharge(int $nb_personne_charge): self
    {
        $this->nb_personne_charge = $nb_personne_charge;

        return $this;
    }

    public function getParentNom(): ?string
    {
        return $this->parent_nom;
    }

    public function setParentNom(string $parent_nom): self
    {
        $this->parent_nom = $parent_nom;

        return $this;
    }

    public function getParentAdresse(): ?string
    {
        return $this->parent_adresse;
    }

    public function setParentAdresse(string $parent_adresse): self
    {
        $this->parent_adresse = $parent_adresse;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, ApprouverClient>
     */
    public function getCodeIndividuel(): Collection
    {
        return $this->CodeIndividuel;
    }

    public function addCodeIndividuel(ApprouverClient $codeIndividuel): self
    {
        if (!$this->CodeIndividuel->contains($codeIndividuel)) {
            $this->CodeIndividuel[] = $codeIndividuel;
            $codeIndividuel->setCodeclient($this);
        }

        return $this;
    }

    public function removeCodeIndividuel(ApprouverClient $codeIndividuel): self
    {
        if ($this->CodeIndividuel->removeElement($codeIndividuel)) {
            // set the owning side to null (unless already changed)
            if ($codeIndividuel->getCodeclient() === $this) {
                $codeIndividuel->setCodeclient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DepotAterme>
     */
    public function getNumCompte(): Collection
    {
        return $this->NumCompte;
    }

    public function addNumCompte(DepotAterme $numCompte): self
    {
        if (!$this->NumCompte->contains($numCompte)) {
            $this->NumCompte[] = $numCompte;
            $numCompte->setCompte($this);
        }

        return $this;
    }

    public function removeNumCompte(DepotAterme $numCompte): self
    {
        if ($this->NumCompte->removeElement($numCompte)) {
            // set the owning side to null (unless already changed)
            if ($numCompte->getCompte() === $this) {
                $numCompte->setCompte(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, CompteEpargne>
     */
    public function getCodecompteepargne(): Collection
    {
        return $this->codecompteepargne;
    }

    public function addCodecompteepargne(CompteEpargne $codecompteepargne): self
    {
        if (!$this->codecompteepargne->contains($codecompteepargne)) {
            $this->codecompteepargne[] = $codecompteepargne;
            $codecompteepargne->setCodeclient($this);
        }

        return $this;
    }

    public function removeCodecompteepargne(CompteEpargne $codecompteepargne): self
    {
        if ($this->codecompteepargne->removeElement($codecompteepargne)) {
            // set the owning side to null (unless already changed)
            if ($codecompteepargne->getCodeclient() === $this) {
                $codecompteepargne->setCodeclient(null);
            }
        }

        return $this;
    }

    public function getEtatcivile(): ?Etatcivile
    {
        return $this->etatcivile;
    }

    public function setEtatcivile(?Etatcivile $etatcivile): self
    {
        $this->etatcivile = $etatcivile;

        return $this;
    }

    public function getEtude(): ?Etude
    {
        return $this->etude;
    }

    public function setEtude(?Etude $etude): self
    {
        $this->etude = $etude;

        return $this;
    }

    public function getTitre(): ?Titre
    {
        return $this->titre;
    }

    public function setTitre(?Titre $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection<int, Mobile>
     */
    public function getMobiles(): Collection
    {
        return $this->mobiles;
    }

    public function addMobile(Mobile $mobile): self
    {
        if (!$this->mobiles->contains($mobile)) {
            $this->mobiles[] = $mobile;
            $mobile->setCodeClient($this);
        }

        return $this;
    }

    public function removeMobile(Mobile $mobile): self
    {
        if ($this->mobiles->removeElement($mobile)) {
            // set the owning side to null (unless already changed)
            if ($mobile->getCodeClient() === $this) {
                $mobile->setCodeClient(null);
            }
        }

        return $this;
    }

    public function getAdressephysique(): ?string
    {
        return $this->adressephysique;
    }

    public function setAdressephysique(string $adressephysique): self
    {
        $this->adressephysique = $adressephysique;

        return $this;
    }

    public function getMembreGroupe(): ?Groupe
    {
        return $this->MembreGroupe;
    }

    public function setMembreGroupe(?Groupe $MembreGroupe): self
    {
        $this->MembreGroupe = $MembreGroupe;

        return $this;
    }

    public function getTitreGroupe(): ?string
    {
        return $this->TitreGroupe;
    }

    public function setTitreGroupe(string $TitreGroupe): self
    {
        $this->TitreGroupe = $TitreGroupe;

        return $this;
    }

    public function getLieudelivrance(): ?string
    {
        return $this->lieudelivrance;
    }

    public function setLieudelivrance(string $lieudelivrance): self
    {
        $this->lieudelivrance = $lieudelivrance;

        return $this;
    }

    public function getDatecin(): ?\DateTimeInterface
    {
        return $this->datecin;
    }

    public function setDatecin(\DateTimeInterface $datecin): self
    {
        $this->datecin = $datecin;

        return $this;
    }

    public function getDateexpiration(): ?\DateTimeInterface
    {
        return $this->dateexpiration;
    }

    public function setDateexpiration(\DateTimeInterface $dateexpiration): self
    {
        $this->dateexpiration = $dateexpiration;

        return $this;
    }

    public function getTypeIdentite(): ?string
    {
        return $this->TypeIdentite;
    }

    public function setTypeIdentite(string $TypeIdentite): self
    {
        $this->TypeIdentite = $TypeIdentite;

        return $this;
    }

    /**
     * @return Collection<int, ListeRouge>
     */
    public function getListeRouges(): Collection
    {
        return $this->listeRouges;
    }

    public function addListeRouge(ListeRouge $listeRouge): self
    {
        if (!$this->listeRouges->contains($listeRouge)) {
            $this->listeRouges[] = $listeRouge;
            $listeRouge->setCodeclient($this);
        }

        return $this;
    }

    public function removeListeRouge(ListeRouge $listeRouge): self
    {
        if ($this->listeRouges->removeElement($listeRouge)) {
            // set the owning side to null (unless already changed)
            if ($listeRouge->getCodeclient() === $this) {
                $listeRouge->setCodeclient(null);
            }
        }

        return $this;
    }

    public function getDateadhesion(): ?\DateTimeInterface
    {
        return $this->dateadhesion;
    }

    public function setDateadhesion(\DateTimeInterface $dateadhesion): self
    {
        $this->dateadhesion = $dateadhesion;

        return $this;
    }

    public function setCodeindividuel(string $codeindividuel): self
    {
        $this->codeindividuel = $codeindividuel;

        return $this;
    }

    /**
     * @return Collection<int, CompteEpargne>
     */
    public function getCodeclientind(): Collection
    {
        return $this->codeclientind;
    }

    public function addCodeclientind(CompteEpargne $codeclientind): self
    {
        if (!$this->codeclientind->contains($codeclientind)) {
            $this->codeclientind[] = $codeclientind;
        }

        return $this;
    }

    public function removeCodeclientind(CompteEpargne $codeclientind): self
    {
        $this->codeclientind->removeElement($codeclientind);

        return $this;
    }



    public function getCodeclient(): ?string
    {
        return $this->codeclient;
    }

    public function setCodeclient(?string $codeclient): self
    {
        $this->codeclient = $codeclient;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->Agence;
    }

    public function setAgence(?Agence $Agence): self
    {
        $this->Agence = $Agence;

        return $this;
    }
}
