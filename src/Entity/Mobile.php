<?php

namespace App\Entity;

use App\Repository\MobileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MobileRepository::class)]
class Mobile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'mobiles')]
    private ?Individuelclient $CodeClient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeClient(): ?Individuelclient
    {
        return $this->CodeClient;
    }

    public function setCodeClient(?Individuelclient $CodeClient): self
    {
        $this->CodeClient = $CodeClient;

        return $this;
    }
}
