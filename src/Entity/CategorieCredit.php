<?php

namespace App\Entity;

use App\Repository\CategorieCreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieCreditRepository::class)]
class CategorieCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomCategorieCredit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorieCredit(): ?string
    {
        return $this->NomCategorieCredit;
    }

    public function setNomCategorieCredit(string $NomCategorieCredit): self
    {
        $this->NomCategorieCredit = $NomCategorieCredit;

        return $this;
    }
}
