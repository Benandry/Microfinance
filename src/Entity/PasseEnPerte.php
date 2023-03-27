<?php

namespace App\Entity;

use App\Repository\PasseEnPerteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PasseEnPerteRepository::class)]
class PasseEnPerte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NumeroCredit = null;

    #[ORM\Column(nullable: true)]
    private ?bool $PasseEnPerte = null;

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

    public function isPasseEnPerte(): ?bool
    {
        return $this->PasseEnPerte;
    }

    public function setPasseEnPerte(?bool $PasseEnPerte): self
    {
        $this->PasseEnPerte = $PasseEnPerte;

        return $this;
    }
}
