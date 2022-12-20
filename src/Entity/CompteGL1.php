<?php

namespace App\Entity;

use App\Repository\CompteGL1Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteGL1Repository::class)]
class CompteGL1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
