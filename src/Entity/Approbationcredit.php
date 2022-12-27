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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateApprobation = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $statusApprobation = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(length: 255)]
    private ?string $codecredit = null;

    #[ORM\ManyToOne(inversedBy: 'approbationCredits')]
    private ?User $agentCredit = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCodecredit(): ?string
    {
        return $this->codecredit;
    }

    public function setCodecredit(string $codecredit): self
    {
        $this->codecredit = $codecredit;

        return $this;
    }

    public function getAgentCredit(): ?User
    {
        return $this->agentCredit;
    }

    public function setAgentCredit(?User $agentCredit): self
    {
        $this->agentCredit = $agentCredit;

        return $this;
    }

}
