<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomCommune = null;

    #[ORM\Column(length: 255)]
    private ?string $CodeCommune = null;


    public function __construct()
    {
        $this->Codecomm = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCommune(): ?string
    {
        return $this->NomCommune;
    }

    public function setNomCommune(string $NomCommune): self
    {
        $this->NomCommune = $NomCommune;

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->CodeCommune;
    }

    public function setCodeCommune(string $CodeCommune): self
    {
        $this->CodeCommune = $CodeCommune;

        return $this;
    }

        public function __toString()
    {
        return (string) $this->getId();
    }
}
