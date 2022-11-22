<?php

namespace App\Entity;

use App\Repository\DeviseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviseRepository::class)]
class Devise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $devise = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\OneToMany(mappedBy: 'deviseutiliser', targetEntity: ConfigEp::class)]
    private Collection $ConfigDevise;

    public function __construct()
    {
        $this->ConfigDevise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(string $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, ConfigEp>
     */
    public function getConfigDevise(): Collection
    {
        return $this->ConfigDevise;
    }

    public function addConfigDevise(ConfigEp $configDevise): self
    {
        if (!$this->ConfigDevise->contains($configDevise)) {
            $this->ConfigDevise[] = $configDevise;
            $configDevise->setDeviseutiliser($this);
        }

        return $this;
    }

    public function removeConfigDevise(ConfigEp $configDevise): self
    {
        if ($this->ConfigDevise->removeElement($configDevise)) {
            // set the owning side to null (unless already changed)
            if ($configDevise->getDeviseutiliser() === $this) {
                $configDevise->setDeviseutiliser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}
