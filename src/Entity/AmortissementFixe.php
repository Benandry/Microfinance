<?php

namespace App\Entity;

use App\Repository\AmortissementFixeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmortissementFixeRepository::class)]
class AmortissementFixe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $periode = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRemborsement = null;

    #[ORM\Column]
    private ?float $principale = null;

    #[ORM\Column]
    private ?float $interet = null;

    #[ORM\Column]
    private ?float $montanttTotal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriode(): ?int
    {
        return $this->periode;
    }

    public function setPeriode(int $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getDateRemborsement(): ?\DateTimeInterface
    {
        return $this->dateRemborsement;
    }

    public function setDateRemborsement(\DateTimeInterface $dateRemborsement): self
    {
        $this->dateRemborsement = $dateRemborsement;

        return $this;
    }

    public function getPrincipale(): ?float
    {
        return $this->principale;
    }

    public function setPrincipale(float $principale): self
    {
        $this->principale = $principale;

        return $this;
    }

    public function getInteret(): ?float
    {
        return $this->interet;
    }

    public function setInteret(float $interet): self
    {
        $this->interet = $interet;

        return $this;
    }

    public function getMontanttTotal(): ?float
    {
        return $this->montanttTotal;
    }

    public function setMontanttTotal(float $montanttTotal): self
    {
        $this->montanttTotal = $montanttTotal;

        return $this;
    }
}