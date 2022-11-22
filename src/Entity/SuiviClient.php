<?php

namespace App\Entity;

use App\Repository\SuiviClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuiviClientRepository::class)]
class SuiviClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateEntre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateSortie = null;

    #[ORM\Column(length: 255)]
    private ?string $Utilisateur = null;

    #[ORM\Column(length: 100)]
    private ?string $menu_utiliser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntre(): ?\DateTimeInterface
    {
        return $this->DateEntre;
    }

    public function setDateEntre(\DateTimeInterface $DateEntre): self
    {
        $this->DateEntre = $DateEntre;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->DateSortie;
    }

    public function setDateSortie(\DateTimeInterface $DateSortie): self
    {
        $this->DateSortie = $DateSortie;

        return $this;
    }

    public function getUtilisateur(): ?string
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(string $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    public function getMenuUtiliser(): ?string
    {
        return $this->menu_utiliser;
    }

    public function setMenuUtiliser(string $menu_utiliser): self
    {
        $this->menu_utiliser = $menu_utiliser;

        return $this;
    }
}
