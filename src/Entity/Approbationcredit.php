<?php

namespace App\Entity;

use App\Repository\ApprobationcreditRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprobationcreditRepository::class)]
class Approbationcredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateap = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $montantapprouver = null;

    #[ORM\Column(length: 255)]
    private ?string $personneap = null;

    #[ORM\Column(length: 255)]
    private ?string $num_credit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateap(): ?\DateTimeInterface
    {
        return $this->dateap;
    }

    public function setDateap(\DateTimeInterface $dateap): self
    {
        $this->dateap = $dateap;

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

    public function getMontantapprouver(): ?float
    {
        return $this->montantapprouver;
    }

    public function setMontantapprouver(float $montantapprouver): self
    {
        $this->montantapprouver = $montantapprouver;

        return $this;
    }

    public function getPersonneap(): ?string
    {
        return $this->personneap;
    }

    public function setPersonneap(string $personneap): self
    {
        $this->personneap = $personneap;

        return $this;
    }

    public function getNumCredit(): ?string
    {
        return $this->num_credit;
    }

    public function setNumCredit(string $num_credit): self
    {
        $this->num_credit = $num_credit;

        return $this;
    }
}
