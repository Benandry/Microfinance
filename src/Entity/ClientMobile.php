<?php

namespace App\Entity;

use App\Repository\ClientMobileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientMobileRepository::class)]
class ClientMobile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $Code_client = null;

    #[ORM\Column(length: 10)]
    private ?string $type_client = null;

    #[ORM\Column(length: 100)]
    private ?string $produit_epargne = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\Column(length: 50)]
    private ?string $numero_mobile = null;

    #[ORM\Column(length: 50)]
    private ?string $code_pin = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeClient(): ?string
    {
        return $this->Code_client;
    }

    public function setCodeClient(string $Code_client): self
    {
        $this->Code_client = $Code_client;

        return $this;
    }

    public function isTypeClient(): ?string
    {
        return $this->type_client;
    }

    public function setTypeClient(string $type_client): self
    {
        $this->type_client = $type_client;

        return $this;
    }

    public function getProduitEpargne(): ?string
    {
        return $this->produit_epargne;
    }

    public function setProduitEpargne(string $produit_epargne): self
    {
        $this->produit_epargne = $produit_epargne;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getNumeroMobile(): ?string
    {
        return $this->numero_mobile;
    }

    public function setNumeroMobile(string $numero_mobile): self
    {
        $this->numero_mobile = $numero_mobile;

        return $this;
    }

    public function getCodePin(): ?string
    {
        return $this->code_pin;
    }

    public function setCodePin(string $code_pin): self
    {
        $this->code_pin = $code_pin;

        return $this;
    }


    public function __toString()
    {
        return (string) $this->getId();
    }
}
