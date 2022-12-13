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

    #[ORM\OneToMany(mappedBy: 'Devise', targetEntity: ConfigurationGeneralCredit::class)]
    private Collection $configurationGeneralCredits;

    #[ORM\OneToMany(mappedBy: 'devise', targetEntity: FondCredit::class)]
    private Collection $fondCredits;

    public function __construct()
    {
        $this->ConfigDevise = new ArrayCollection();
        $this->configurationGeneralCredits = new ArrayCollection();
        $this->fondCredits = new ArrayCollection();
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

    /**
     * @return Collection<int, ConfigurationGeneralCredit>
     */
    public function getConfigurationGeneralCredits(): Collection
    {
        return $this->configurationGeneralCredits;
    }

    public function addConfigurationGeneralCredit(ConfigurationGeneralCredit $configurationGeneralCredit): self
    {
        if (!$this->configurationGeneralCredits->contains($configurationGeneralCredit)) {
            $this->configurationGeneralCredits[] = $configurationGeneralCredit;
            $configurationGeneralCredit->setDevise($this);
        }

        return $this;
    }

    public function removeConfigurationGeneralCredit(ConfigurationGeneralCredit $configurationGeneralCredit): self
    {
        if ($this->configurationGeneralCredits->removeElement($configurationGeneralCredit)) {
            // set the owning side to null (unless already changed)
            if ($configurationGeneralCredit->getDevise() === $this) {
                $configurationGeneralCredit->setDevise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FondCredit>
     */
    public function getFondCredits(): Collection
    {
        return $this->fondCredits;
    }

    public function addFondCredit(FondCredit $fondCredit): self
    {
        if (!$this->fondCredits->contains($fondCredit)) {
            $this->fondCredits[] = $fondCredit;
            $fondCredit->setDevise($this);
        }

        return $this;
    }

    public function removeFondCredit(FondCredit $fondCredit): self
    {
        if ($this->fondCredits->removeElement($fondCredit)) {
            // set the owning side to null (unless already changed)
            if ($fondCredit->getDevise() === $this) {
                $fondCredit->setDevise(null);
            }
        }

        return $this;
    }
}
