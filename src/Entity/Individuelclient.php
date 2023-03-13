<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\IndividuelclientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndividuelclientRepository::class)]

#[ApiResource()]
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
    private ?string $nomConjoint = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_inscription = null;

    #[ORM\Column(length: 10)]
    private ?string $sexe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroMobile = null;

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

    #[ORM\ManyToMany(targetEntity: CompteEpargne::class, inversedBy: 'codeindcl')]
    private Collection $codeclientind;


    #[ORM\Column(length: 30, nullable: true)]
    private ?string $codeclient = null;

    #[ORM\Column(nullable: true)]
    private ?bool $garant = null;


    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateadhesion = null;

    #[ORM\ManyToOne(inversedBy: 'individuelclients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'individuelclients')]
    private ?Agence $Agence = null;

    #[ORM\ManyToOne(inversedBy: 'individuelclients')]
    private ?Commune $commune = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PrenomConjoint = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateNaissanceConjoint = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CINConjoint = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ProfessionConjoint = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PrenomParent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CINParent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FokontanyParent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CommuneParent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DistrictParent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $RegionParent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Fokontany = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $District = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Longitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Latitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FormationProfessionnelle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Information = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Activite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SecteurActivite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LibelleMoyenProduction = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMoyenProduction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LibelleMoyenProduction2 = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMoyenProduction2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LibelleMoyenProduction3 = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMoyenProduction3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LibelleMoyenProduction4 = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMoyenProduction4 = null;

    #[ORM\Column(nullable: true)]
    private ?float $EmployeTemporaire = null;

    #[ORM\Column(nullable: true)]
    private ?float $EmployePermanant = null;

    #[ORM\Column(nullable: true)]
    private ?float $CoutEmployePermanent = null;

    #[ORM\Column(nullable: true)]
    private ?float $CoutEmployeTemporaire = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $ActiviteComplementaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SecteurActvtComplmtr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LibellMoyenProdCmplmtr = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMoyenProdCmplmtr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LibellMoyenProdCmplmtr2 = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMoyenProdCmplmtr2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LibellMoyenProdCmplmtr3 = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMoyenProdCmplmtr3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LibellMoyenProdCmplmtr4 = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantMoyenProdCmplmtr4 = null;

    #[ORM\Column(nullable: true)]
    private ?float $EmployeTemprarCmplt = null;

    #[ORM\Column(nullable: true)]
    private ?float $CoutEmployeTmprCmplmt = null;

    #[ORM\Column(nullable: true)]
    private ?float $EmployePermntCmpltmt = null;

    #[ORM\Column(nullable: true)]
    private ?float $CoutEmployePermntCmpltmt = null;

    #[ORM\OneToMany(mappedBy: 'individuelclient', targetEntity: CompteEpargne::class)]
    private Collection $compteEpargnes;

    
    public function __construct()
    {
        $this->CodeIndividuel = new ArrayCollection();
       // $this->CompteMembreIndividuel = new ArrayCollection();
        $this->mobiles = new ArrayCollection();
       // $this->docIdentites = new ArrayCollection();
        $this->listeRouges = new ArrayCollection();
        $this->codeclientind = new ArrayCollection();
        $this->compteEpargnes = new ArrayCollection();
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
        return $this->nomConjoint;
    }

    public function setNomConjoint(string $nomConjoint): self
    {
        $this->nomConjoint = $nomConjoint;

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
        return $this->numeroMobile;
    }

    public function setNumeroMobile(string $numeroMobile): self
    {
        $this->numeroMobile = $numeroMobile;

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

    public function setCodeindividuel(string $codeindividuel): self
    {
        $this->CodeIndividuel = $codeindividuel;

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
    public function isGarant(): ?bool
    {
        return $this->garant;
    }

    public function setGarant(?bool $garant): self
    {
        $this->garant = $garant;

        return $this;
    }

    public function getDateadhesion(): ?\DateTimeInterface
    {
        return $this->dateadhesion;
    }

    public function setDateadhesion(?\DateTimeInterface $dateadhesion): self
    {
        $this->dateadhesion = $dateadhesion;

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

    public function getAgence(): ?Agence
    {
        return $this->Agence;
    }

    public function setAgence(?Agence $Agence): self
    {
        $this->Agence = $Agence;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getPrenomConjoint(): ?string
    {
        return $this->PrenomConjoint;
    }

    public function setPrenomConjoint(?string $PrenomConjoint): self
    {
        $this->PrenomConjoint = $PrenomConjoint;

        return $this;
    }

    public function getDateNaissanceConjoint(): ?\DateTimeInterface
    {
        return $this->DateNaissanceConjoint;
    }

    public function setDateNaissanceConjoint(?\DateTimeInterface $DateNaissanceConjoint): self
    {
        $this->DateNaissanceConjoint = $DateNaissanceConjoint;

        return $this;
    }

    public function getCINConjoint(): ?string
    {
        return $this->CINConjoint;
    }

    public function setCINConjoint(?string $CINConjoint): self
    {
        $this->CINConjoint = $CINConjoint;

        return $this;
    }

    public function getProfessionConjoint(): ?string
    {
        return $this->ProfessionConjoint;
    }

    public function setProfessionConjoint(?string $ProfessionConjoint): self
    {
        $this->ProfessionConjoint = $ProfessionConjoint;

        return $this;
    }

    public function getPrenomParent(): ?string
    {
        return $this->PrenomParent;
    }

    public function setPrenomParent(?string $PrenomParent): self
    {
        $this->PrenomParent = $PrenomParent;

        return $this;
    }

    public function getCINParent(): ?string
    {
        return $this->CINParent;
    }

    public function setCINParent(?string $CINParent): self
    {
        $this->CINParent = $CINParent;

        return $this;
    }

    public function getFokontanyParent(): ?string
    {
        return $this->FokontanyParent;
    }

    public function setFokontanyParent(?string $FokontanyParent): self
    {
        $this->FokontanyParent = $FokontanyParent;

        return $this;
    }

    public function getCommuneParent(): ?string
    {
        return $this->CommuneParent;
    }

    public function setCommuneParent(?string $CommuneParent): self
    {
        $this->CommuneParent = $CommuneParent;

        return $this;
    }

    public function getDistrictParent(): ?string
    {
        return $this->DistrictParent;
    }

    public function setDistrictParent(?string $DistrictParent): self
    {
        $this->DistrictParent = $DistrictParent;

        return $this;
    }

    public function getRegionParent(): ?string
    {
        return $this->RegionParent;
    }

    public function setRegionParent(?string $RegionParent): self
    {
        $this->RegionParent = $RegionParent;

        return $this;
    }

    public function getFokontany(): ?string
    {
        return $this->Fokontany;
    }

    public function setFokontany(?string $Fokontany): self
    {
        $this->Fokontany = $Fokontany;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->District;
    }

    public function setDistrict(?string $District): self
    {
        $this->District = $District;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(?string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->Longitude;
    }

    public function setLongitude(?string $Longitude): self
    {
        $this->Longitude = $Longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->Latitude;
    }

    public function setLatitude(?string $Latitude): self
    {
        $this->Latitude = $Latitude;

        return $this;
    }

    public function getFormationProfessionnelle(): ?string
    {
        return $this->FormationProfessionnelle;
    }

    public function setFormationProfessionnelle(?string $FormationProfessionnelle): self
    {
        $this->FormationProfessionnelle = $FormationProfessionnelle;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->Information;
    }

    public function setInformation(?string $Information): self
    {
        $this->Information = $Information;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->Activite;
    }

    public function setActivite(?string $Activite): self
    {
        $this->Activite = $Activite;

        return $this;
    }

    public function getSecteurActivite(): ?string
    {
        return $this->SecteurActivite;
    }

    public function setSecteurActivite(?string $SecteurActivite): self
    {
        $this->SecteurActivite = $SecteurActivite;

        return $this;
    }

    public function getLibelleMoyenProduction(): ?string
    {
        return $this->LibelleMoyenProduction;
    }

    public function setLibelleMoyenProduction(?string $LibelleMoyenProduction): self
    {
        $this->LibelleMoyenProduction = $LibelleMoyenProduction;

        return $this;
    }

    public function getMontantMoyenProduction(): ?float
    {
        return $this->MontantMoyenProduction;
    }

    public function setMontantMoyenProduction(?float $MontantMoyenProduction): self
    {
        $this->MontantMoyenProduction = $MontantMoyenProduction;

        return $this;
    }

    public function getLibelleMoyenProduction2(): ?string
    {
        return $this->LibelleMoyenProduction2;
    }

    public function setLibelleMoyenProduction2(?string $LibelleMoyenProduction2): self
    {
        $this->LibelleMoyenProduction2 = $LibelleMoyenProduction2;

        return $this;
    }

    public function getMontantMoyenProduction2(): ?float
    {
        return $this->MontantMoyenProduction2;
    }

    public function setMontantMoyenProduction2(?float $MontantMoyenProduction2): self
    {
        $this->MontantMoyenProduction2 = $MontantMoyenProduction2;

        return $this;
    }

    public function getLibelleMoyenProduction3(): ?string
    {
        return $this->LibelleMoyenProduction3;
    }

    public function setLibelleMoyenProduction3(?string $LibelleMoyenProduction3): self
    {
        $this->LibelleMoyenProduction3 = $LibelleMoyenProduction3;

        return $this;
    }

    public function getMontantMoyenProduction3(): ?float
    {
        return $this->MontantMoyenProduction3;
    }

    public function setMontantMoyenProduction3(?float $MontantMoyenProduction3): self
    {
        $this->MontantMoyenProduction3 = $MontantMoyenProduction3;

        return $this;
    }

    public function getLibelleMoyenProduction4(): ?string
    {
        return $this->LibelleMoyenProduction4;
    }

    public function setLibelleMoyenProduction4(?string $LibelleMoyenProduction4): self
    {
        $this->LibelleMoyenProduction4 = $LibelleMoyenProduction4;

        return $this;
    }

    public function getMontantMoyenProduction4(): ?float
    {
        return $this->MontantMoyenProduction4;
    }

    public function setMontantMoyenProduction4(?float $MontantMoyenProduction4): self
    {
        $this->MontantMoyenProduction4 = $MontantMoyenProduction4;

        return $this;
    }

    public function getEmployeTemporaire(): ?float
    {
        return $this->EmployeTemporaire;
    }

    public function setEmployeTemporaire(?float $EmployeTemporaire): self
    {
        $this->EmployeTemporaire = $EmployeTemporaire;

        return $this;
    }

    public function getEmployePermanant(): ?float
    {
        return $this->EmployePermanant;
    }

    public function setEmployePermanant(?float $EmployePermanant): self
    {
        $this->EmployePermanant = $EmployePermanant;

        return $this;
    }

    public function getCoutEmployePermanent(): ?float
    {
        return $this->CoutEmployePermanent;
    }

    public function setCoutEmployePermanent(?float $CoutEmployePermanent): self
    {
        $this->CoutEmployePermanent = $CoutEmployePermanent;

        return $this;
    }

    public function getCoutEmployeTemporaire(): ?float
    {
        return $this->CoutEmployeTemporaire;
    }

    public function setCoutEmployeTemporaire(?float $CoutEmployeTemporaire): self
    {
        $this->CoutEmployeTemporaire = $CoutEmployeTemporaire;

        return $this;
    }

    public function getActiviteComplementaire(): ?string
    {
        return $this->ActiviteComplementaire;
    }

    public function setActiviteComplementaire(?string $ActiviteComplementaire): self
    {
        $this->ActiviteComplementaire = $ActiviteComplementaire;

        return $this;
    }

    public function getSecteurActvtComplmtr(): ?string
    {
        return $this->SecteurActvtComplmtr;
    }

    public function setSecteurActvtComplmtr(?string $SecteurActvtComplmtr): self
    {
        $this->SecteurActvtComplmtr = $SecteurActvtComplmtr;

        return $this;
    }

    public function getLibellMoyenProdCmplmtr(): ?string
    {
        return $this->LibellMoyenProdCmplmtr;
    }

    public function setLibellMoyenProdCmplmtr(?string $LibellMoyenProdCmplmtr): self
    {
        $this->LibellMoyenProdCmplmtr = $LibellMoyenProdCmplmtr;

        return $this;
    }

    public function getMontantMoyenProdCmplmtr(): ?float
    {
        return $this->MontantMoyenProdCmplmtr;
    }

    public function setMontantMoyenProdCmplmtr(?float $MontantMoyenProdCmplmtr): self
    {
        $this->MontantMoyenProdCmplmtr = $MontantMoyenProdCmplmtr;

        return $this;
    }

    public function getLibellMoyenProdCmplmtr2(): ?string
    {
        return $this->LibellMoyenProdCmplmtr2;
    }

    public function setLibellMoyenProdCmplmtr2(?string $LibellMoyenProdCmplmtr2): self
    {
        $this->LibellMoyenProdCmplmtr2 = $LibellMoyenProdCmplmtr2;

        return $this;
    }

    public function getMontantMoyenProdCmplmtr2(): ?float
    {
        return $this->MontantMoyenProdCmplmtr2;
    }

    public function setMontantMoyenProdCmplmtr2(?float $MontantMoyenProdCmplmtr2): self
    {
        $this->MontantMoyenProdCmplmtr2 = $MontantMoyenProdCmplmtr2;

        return $this;
    }

    public function getLibellMoyenProdCmplmtr3(): ?string
    {
        return $this->LibellMoyenProdCmplmtr3;
    }

    public function setLibellMoyenProdCmplmtr3(?string $LibellMoyenProdCmplmtr3): self
    {
        $this->LibellMoyenProdCmplmtr3 = $LibellMoyenProdCmplmtr3;

        return $this;
    }

    public function getMontantMoyenProdCmplmtr3(): ?float
    {
        return $this->MontantMoyenProdCmplmtr3;
    }

    public function setMontantMoyenProdCmplmtr3(?float $MontantMoyenProdCmplmtr3): self
    {
        $this->MontantMoyenProdCmplmtr3 = $MontantMoyenProdCmplmtr3;

        return $this;
    }

    public function getLibellMoyenProdCmplmtr4(): ?string
    {
        return $this->LibellMoyenProdCmplmtr4;
    }

    public function setLibellMoyenProdCmplmtr4(?string $LibellMoyenProdCmplmtr4): self
    {
        $this->LibellMoyenProdCmplmtr4 = $LibellMoyenProdCmplmtr4;

        return $this;
    }

    public function getMontantMoyenProdCmplmtr4(): ?float
    {
        return $this->MontantMoyenProdCmplmtr4;
    }

    public function setMontantMoyenProdCmplmtr4(?float $MontantMoyenProdCmplmtr4): self
    {
        $this->MontantMoyenProdCmplmtr4 = $MontantMoyenProdCmplmtr4;

        return $this;
    }

    public function getEmployeTemprarCmplt(): ?float
    {
        return $this->EmployeTemprarCmplt;
    }

    public function setEmployeTemprarCmplt(?float $EmployeTemprarCmplt): self
    {
        $this->EmployeTemprarCmplt = $EmployeTemprarCmplt;

        return $this;
    }

    public function getCoutEmployeTmprCmplmt(): ?float
    {
        return $this->CoutEmployeTmprCmplmt;
    }

    public function setCoutEmployeTmprCmplmt(?float $CoutEmployeTmprCmplmt): self
    {
        $this->CoutEmployeTmprCmplmt = $CoutEmployeTmprCmplmt;

        return $this;
    }

    public function getEmployePermntCmpltmt(): ?float
    {
        return $this->EmployePermntCmpltmt;
    }

    public function setEmployePermntCmpltmt(?float $EmployePermntCmpltmt): self
    {
        $this->EmployePermntCmpltmt = $EmployePermntCmpltmt;

        return $this;
    }

    public function getCoutEmployePermntCmpltmt(): ?float
    {
        return $this->CoutEmployePermntCmpltmt;
    }

    public function setCoutEmployePermntCmpltmt(?float $CoutEmployePermntCmpltmt): self
    {
        $this->CoutEmployePermntCmpltmt = $CoutEmployePermntCmpltmt;

        return $this;
    }

    /**
     * @return Collection<int, CompteEpargne>
     */
    public function getCompteEpargnes(): Collection
    {
        return $this->compteEpargnes;
    }

    public function addCompteEpargne(CompteEpargne $compteEpargne): self
    {
        if (!$this->compteEpargnes->contains($compteEpargne)) {
            $this->compteEpargnes->add($compteEpargne);
            $compteEpargne->setIndividuelclient($this);
        }

        return $this;
    }

    public function removeCompteEpargne(CompteEpargne $compteEpargne): self
    {
        if ($this->compteEpargnes->removeElement($compteEpargne)) {
            // set the owning side to null (unless already changed)
            if ($compteEpargne->getIndividuelclient() === $this) {
                $compteEpargne->setIndividuelclient(null);
            }
        }

        return $this;
    }

}
