<?php

namespace App\Entity;

use App\Repository\ApprouverClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprouverClientRepository::class)]
class ApprouverClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'CodeIndividuel')]
    private ?Individuelclient $codeclient = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateapprobation = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateapprobation(): ?\DateTimeInterface
    {
        return $this->dateapprobation;
    }

    public function setDateapprobation(\DateTimeInterface $dateapprobation): self
    {
        $this->dateapprobation = $dateapprobation;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}
