<?php

namespace App\Entity;

use App\Repository\ApprobationCreditRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprobationCreditRepository::class)]
class ApprobationCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'approbationCredits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DemandeCredit $demande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateApprobation = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $statusApprobation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDemande(): ?DemandeCredit
    {
        return $this->demande;
    }

    public function setDemande(?DemandeCredit $demande): self
    {
        $this->demande = $demande;

        return $this;
    }

    public function getDateApprobation(): ?\DateTimeInterface
    {
        return $this->dateApprobation;
    }

    public function setDateApprobation(\DateTimeInterface $dateApprobation): self
    {
        $this->dateApprobation = $dateApprobation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatusApprobation(): ?string
    {
        return $this->statusApprobation;
    }

    public function setStatusApprobation(string $statusApprobation): self
    {
        $this->statusApprobation = $statusApprobation;

        return $this;
    }
}
