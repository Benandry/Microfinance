<?php

namespace App\Entity;

use App\Repository\ReechelonnementCreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReechelonnementCreditRepository::class)]
class ReechelonnementCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NumeroCredit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CodeClient = null;

    #[ORM\Column(nullable: true)]
    private ?int $ResteCredit = null;

    #[ORM\Column(nullable: true)]
    private ?int $RestePeriode = null;

    #[ORM\Column(nullable: true)]
    private ?int $ResteCapital = null;

    #[ORM\Column(nullable: true)]
    private ?int $ResteInteret = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCredit(): ?string
    {
        return $this->NumeroCredit;
    }

    public function setNumeroCredit(?string $NumeroCredit): self
    {
        $this->NumeroCredit = $NumeroCredit;

        return $this;
    }

    public function getCodeClient(): ?string
    {
        return $this->CodeClient;
    }

    public function setCodeClient(?string $CodeClient): self
    {
        $this->CodeClient = $CodeClient;

        return $this;
    }

    public function getResteCredit(): ?int
    {
        return $this->ResteCredit;
    }

    public function setResteCredit(?int $ResteCredit): self
    {
        $this->ResteCredit = $ResteCredit;

        return $this;
    }

    public function getRestePeriode(): ?int
    {
        return $this->RestePeriode;
    }

    public function setRestePeriode(?int $RestePeriode): self
    {
        $this->RestePeriode = $RestePeriode;

        return $this;
    }

    public function getResteCapital(): ?int
    {
        return $this->ResteCapital;
    }

    public function setResteCapital(?int $ResteCapital): self
    {
        $this->ResteCapital = $ResteCapital;

        return $this;
    }

    public function getResteInteret(): ?int
    {
        return $this->ResteInteret;
    }

    public function setResteInteret(?int $ResteInteret): self
    {
        $this->ResteInteret = $ResteInteret;

        return $this;
    }
}
