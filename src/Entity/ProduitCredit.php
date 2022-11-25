<?php

namespace App\Entity;

use App\Repository\ProduitCreditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitCreditRepository::class)]
class ProduitCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomProduitCredit = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: ConfigurationGeneralCredit::class)]
    private Collection $configurationGeneralCredits;

    public function __construct()
    {
        $this->configurationGeneralCredits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduitCredit(): ?string
    {
        return $this->NomProduitCredit;
    }

    public function setNomProduitCredit(string $NomProduitCredit): self
    {
        $this->NomProduitCredit = $NomProduitCredit;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
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
            $configurationGeneralCredit->setProduitCredit($this);
        }

        return $this;
    }

    public function removeConfigurationGeneralCredit(ConfigurationGeneralCredit $configurationGeneralCredit): self
    {
        if ($this->configurationGeneralCredits->removeElement($configurationGeneralCredit)) {
            // set the owning side to null (unless already changed)
            if ($configurationGeneralCredit->getProduitCredit() === $this) {
                $configurationGeneralCredit->setProduitCredit(null);
            }
        }

        return $this;
    }
}
