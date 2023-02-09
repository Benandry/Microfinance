<?php

namespace App\Entity;

use App\Repository\JournalComptabiliteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JournalComptabiliteRepository::class)]
class JournalComptabilite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $compteepargne = null;

    #[ORM\Column]
    private ?int $debit = null;

    #[ORM\Column]
    private ?int $credit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompteepargne(): ?string
    {
        return $this->compteepargne;
    }

    public function setCompteepargne(string $compteepargne): self
    {
        $this->compteepargne = $compteepargne;

        return $this;
    }

    public function getDebit(): ?int
    {
        return $this->debit;
    }

    public function setDebit(int $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(int $credit): self
    {
        $this->credit = $credit;

        return $this;
    }
}
