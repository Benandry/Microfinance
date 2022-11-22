<?php

namespace App\Entity;

use App\Repository\ListeRougeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeRougeRepository::class)]
class ListeRouge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateliste = null;

    #[ORM\Column(length: 255)]
    private ?string $raison = null;

    #[ORM\ManyToOne(inversedBy: 'listeRouges')]
    private ?Groupe $codegroupe = null;

    #[ORM\ManyToOne(inversedBy: 'listeRouges')]
    private ?Individuelclient $codeclient = null;

    #[ORM\Column(length: 120)]
    private ?string $TypeClient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateliste(): ?\DateTimeInterface
    {
        return $this->dateliste;
    }

    public function setDateliste(\DateTimeInterface $dateliste): self
    {
        $this->dateliste = $dateliste;

        return $this;
    }

    public function getRaison(): ?string
    {
        return $this->raison;
    }

    public function setRaison(string $raison): self
    {
        $this->raison = $raison;

        return $this;
    }

    public function getCodegroupe(): ?Groupe
    {
        return $this->codegroupe;
    }

    public function setCodegroupe(?Groupe $codegroupe): self
    {
        $this->codegroupe = $codegroupe;

        return $this;
    }

    public function getCodeclient(): ?Individuelclient
    {
        return $this->codeclient;
    }

    public function setCodeclient(?Individuelclient $codeclient): self
    {
        $this->codeclient = $codeclient;

        return $this;
    }

    public function getTypeClient(): ?string
    {
        return $this->TypeClient;
    }

    public function setTypeClient(string $TypeClient): self
    {
        $this->TypeClient = $TypeClient;

        return $this;
    }
}
