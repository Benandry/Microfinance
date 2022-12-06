<?php

namespace App\Entity;

use App\Repository\GarantieCreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarantieCreditRepository::class)]
class GarantieCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(nullable:true)]
    private ?bool $CreditBaseEpargne = null;

    #[ORM\ManyToOne(inversedBy: 'garantieCredits')]
    private ?ProduitEpargne $ProduitEpargne = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantCreditDmdIndividuel = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantCreditDmdGroupe = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantCrdAnciensCreditenCours = null;

    #[ORM\Column(nullable: true)]
    private ?float $MontantCrdAnciensCreditenCoursGrp = null;

    #[ORM\Column(nullable: true)]
    private ?bool $GarantieBaseMontantCredit = null;

    #[ORM\Column(nullable: true)]
    private ?bool $DeduireGarantieAuDecaissement = null;

    #[ORM\Column(nullable: true)]
    private ?bool $DeduireGarantieAuDecaissementGrp = null;

    #[ORM\Column(nullable: true)]
    private ?bool $GarantieObligatoireCreditInd = null;

    #[ORM\Column(nullable: true)]
    private ?int $MontantExige = null;

    #[ORM\Column(length: 255)]
    private ?string $regle = null;

    #[ORM\Column(nullable: true)]
    private ?bool $GarantObligatoireCreditInd = null;

    #[ORM\Column(nullable:true)]
    private ?int $MontantGarant = null;

    #[ORM\Column(nullable: true)]
    private ?bool $GarantObligatoireCreditGrp = null;

    #[ORM\Column(nullable: true)]
    private ?int $MontantGarantieGrp = null;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $reglegrp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCreditBaseEpargne(): ?bool
    {
        return $this->CreditBaseEpargne;
    }

    public function setCreditBaseEpargne(bool $CreditBaseEpargne): self
    {
        $this->CreditBaseEpargne = $CreditBaseEpargne;

        return $this;
    }

    public function getProduitEpargne(): ?ProduitEpargne
    {
        return $this->ProduitEpargne;
    }

    public function setProduitEpargne(?ProduitEpargne $ProduitEpargne): self
    {
        $this->ProduitEpargne = $ProduitEpargne;

        return $this;
    }

    public function getMontantCreditDmdIndividuel(): ?float
    {
        return $this->MontantCreditDmdIndividuel;
    }

    public function setMontantCreditDmdIndividuel(?float $MontantCreditDmdIndividuel): self
    {
        $this->MontantCreditDmdIndividuel = $MontantCreditDmdIndividuel;

        return $this;
    }

    public function getMontantCreditDmdGroupe(): ?float
    {
        return $this->MontantCreditDmdGroupe;
    }

    public function setMontantCreditDmdGroupe(?float $MontantCreditDmdGroupe): self
    {
        $this->MontantCreditDmdGroupe = $MontantCreditDmdGroupe;

        return $this;
    }

    public function getMontantCrdAnciensCreditenCours(): ?float
    {
        return $this->MontantCrdAnciensCreditenCours;
    }

    public function setMontantCrdAnciensCreditenCours(?float $MontantCrdAnciensCreditenCours): self
    {
        $this->MontantCrdAnciensCreditenCours = $MontantCrdAnciensCreditenCours;

        return $this;
    }

    public function getMontantCrdAnciensCreditenCoursGrp(): ?float
    {
        return $this->MontantCrdAnciensCreditenCoursGrp;
    }

    public function setMontantCrdAnciensCreditenCoursGrp(?float $MontantCrdAnciensCreditenCoursGrp): self
    {
        $this->MontantCrdAnciensCreditenCoursGrp = $MontantCrdAnciensCreditenCoursGrp;

        return $this;
    }

    public function isGarantieBaseMontantCredit(): ?bool
    {
        return $this->GarantieBaseMontantCredit;
    }

    public function setGarantieBaseMontantCredit(?bool $GarantieBaseMontantCredit): self
    {
        $this->GarantieBaseMontantCredit = $GarantieBaseMontantCredit;

        return $this;
    }

    public function isDeduireGarantieAuDecaissement(): ?bool
    {
        return $this->DeduireGarantieAuDecaissement;
    }

    public function setDeduireGarantieAuDecaissement(?bool $DeduireGarantieAuDecaissement): self
    {
        $this->DeduireGarantieAuDecaissement = $DeduireGarantieAuDecaissement;

        return $this;
    }

    public function isDeduireGarantieAuDecaissementGrp(): ?bool
    {
        return $this->DeduireGarantieAuDecaissementGrp;
    }

    public function setDeduireGarantieAuDecaissementGrp(?bool $DeduireGarantieAuDecaissementGrp): self
    {
        $this->DeduireGarantieAuDecaissementGrp = $DeduireGarantieAuDecaissementGrp;

        return $this;
    }

    public function isGarantieObligatoireCreditInd(): ?bool
    {
        return $this->GarantieObligatoireCreditInd;
    }

    public function setGarantieObligatoireCreditInd(?bool $GarantieObligatoireCreditInd): self
    {
        $this->GarantieObligatoireCreditInd = $GarantieObligatoireCreditInd;

        return $this;
    }

    public function getMontantExige(): ?int
    {
        return $this->MontantExige;
    }

    public function setMontantExige(?int $MontantExige): self
    {
        $this->MontantExige = $MontantExige;

        return $this;
    }

    public function getRegle(): ?string
    {
        return $this->regle;
    }

    public function setRegle(string $regle): self
    {
        $this->regle = $regle;

        return $this;
    }

    public function isGarantObligatoireCreditInd(): ?bool
    {
        return $this->GarantObligatoireCreditInd;
    }

    public function setGarantObligatoireCreditInd(?bool $GarantObligatoireCreditInd): self
    {
        $this->GarantObligatoireCreditInd = $GarantObligatoireCreditInd;

        return $this;
    }

    public function getMontantGarant(): ?int
    {
        return $this->MontantGarant;
    }

    public function setMontantGarant(int $MontantGarant): self
    {
        $this->MontantGarant = $MontantGarant;

        return $this;
    }

    public function isGarantObligatoireCreditGrp(): ?bool
    {
        return $this->GarantObligatoireCreditGrp;
    }

    public function setGarantObligatoireCreditGrp(?bool $GarantObligatoireCreditGrp): self
    {
        $this->GarantObligatoireCreditGrp = $GarantObligatoireCreditGrp;

        return $this;
    }

    public function getMontantGarantieGrp(): ?int
    {
        return $this->MontantGarantieGrp;
    }

    public function setMontantGarantieGrp(?int $MontantGarantieGrp): self
    {
        $this->MontantGarantieGrp = $MontantGarantieGrp;

        return $this;
    }

    public function getReglegrp(): ?string
    {
        return $this->reglegrp;
    }

    public function setReglegrp(string $reglegrp): self
    {
        $this->reglegrp = $reglegrp;

        return $this;
    }
}
