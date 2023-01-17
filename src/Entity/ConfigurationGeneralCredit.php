<?php

namespace App\Entity;

use App\Repository\ConfigurationGeneralCreditRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigurationGeneralCreditRepository::class)]
class ConfigurationGeneralCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'configurationGeneralCredits')]
    private ?ProduitCredit $ProduitCredit = null;

    // #[ORM\Column(nullable:true)]
    // private ?bool $ProduitLieEpargne = null;

    #[ORM\Column(nullable:true)]
    private ?int $NombreJourInteretAnnee = null;

    #[ORM\Column(nullable:true)]
    private ?int $NombreSemaineAnnee = null;

    #[ORM\ManyToOne(inversedBy: 'configurationGeneralCredits')]
    private ?Devise $Devise = null;

    #[ORM\Column(type: Types::TEXT,nullable:true)]
    private ?string $RecalculDateEcheanceDecaissement = null;

    #[ORM\Column(nullable:true)]
    private ?int $TauxInteretVariableSoldeDegressif = null;

    #[ORM\Column(nullable:true)]
    private ?bool $RecalculInteretRemboursementAmortissementDegressif = null;

    #[ORM\Column(nullable:true)]
    private ?bool $MethodeSoldeDegressifComposeCalculInteret = null;

    #[ORM\Column(nullable:true)]
    private ?bool $ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt = null;

    #[ORM\Column(nullable:true)]
    private ?bool $AutorisationDecaissementPartiellement = null;

    #[ORM\Column(nullable:true)]
    private ?bool $AcrivePrioriteRemboursementCredit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduitCredit(): ?ProduitCredit
    {
        return $this->ProduitCredit;
    }

    public function setProduitCredit(?ProduitCredit $ProduitCredit): self
    {
        $this->ProduitCredit = $ProduitCredit;

        return $this;
    }

    // public function isProduitLieEpargne(): ?bool
    // {
    //     return $this->ProduitLieEpargne;
    // }

    // public function setProduitLieEpargne(bool $ProduitLieEpargne): self
    // {
    //     $this->ProduitLieEpargne = $ProduitLieEpargne;

    //     return $this;
    // }

    public function getNombreJourInteretAnnee(): ?int
    {
        return $this->NombreJourInteretAnnee;
    }

    public function setNombreJourInteretAnnee(int $NombreJourInteretAnnee): self
    {
        $this->NombreJourInteretAnnee = $NombreJourInteretAnnee;

        return $this;
    }

    public function getNombreSemaineAnnee(): ?int
    {
        return $this->NombreSemaineAnnee;
    }

    public function setNombreSemaineAnnee(int $NombreSemaineAnnee): self
    {
        $this->NombreSemaineAnnee = $NombreSemaineAnnee;

        return $this;
    }

    public function getDevise(): ?Devise
    {
        return $this->Devise;
    }

    public function setDevise(?Devise $Devise): self
    {
        $this->Devise = $Devise;

        return $this;
    }

    public function getRecalculDateEcheanceDecaissement(): ?string
    {
        return $this->RecalculDateEcheanceDecaissement;
    }

    public function setRecalculDateEcheanceDecaissement(string $RecalculDateEcheanceDecaissement): self
    {
        $this->RecalculDateEcheanceDecaissement = $RecalculDateEcheanceDecaissement;

        return $this;
    }

    public function getTauxInteretVariableSoldeDegressif(): ?int
    {
        return $this->TauxInteretVariableSoldeDegressif;
    }

    public function setTauxInteretVariableSoldeDegressif(int $TauxInteretVariableSoldeDegressif): self
    {
        $this->TauxInteretVariableSoldeDegressif = $TauxInteretVariableSoldeDegressif;

        return $this;
    }

    public function isRecalculInteretRemboursementAmortissementDegressif(): ?bool
    {
        return $this->RecalculInteretRemboursementAmortissementDegressif;
    }

    public function setRecalculInteretRemboursementAmortissementDegressif(bool $RecalculInteretRemboursementAmortissementDegressif): self
    {
        $this->RecalculInteretRemboursementAmortissementDegressif = $RecalculInteretRemboursementAmortissementDegressif;

        return $this;
    }

    public function isMethodeSoldeDegressifComposeCalculInteret(): ?bool
    {
        return $this->MethodeSoldeDegressifComposeCalculInteret;
    }

    public function setMethodeSoldeDegressifComposeCalculInteret(bool $MethodeSoldeDegressifComposeCalculInteret): self
    {
        $this->MethodeSoldeDegressifComposeCalculInteret = $MethodeSoldeDegressifComposeCalculInteret;

        return $this;
    }

    public function isExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt(): ?bool
    {
        return $this->ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt;
    }

    public function setExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt(bool $ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt): self
    {
        $this->ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt = $ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt;

        return $this;
    }

    public function isAutorisationDecaissementPartiellement(): ?bool
    {
        return $this->AutorisationDecaissementPartiellement;
    }

    public function setAutorisationDecaissementPartiellement(bool $AutorisationDecaissementPartiellement): self
    {
        $this->AutorisationDecaissementPartiellement = $AutorisationDecaissementPartiellement;

        return $this;
    }

    public function isAcrivePrioriteRemboursementCredit(): ?bool
    {
        return $this->AcrivePrioriteRemboursementCredit;
    }

    public function setAcrivePrioriteRemboursementCredit(bool $AcrivePrioriteRemboursementCredit): self
    {
        $this->AcrivePrioriteRemboursementCredit = $AcrivePrioriteRemboursementCredit;

        return $this;
    }
}
