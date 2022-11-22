<?php

namespace App\Entity;

use App\Repository\TypeEpargneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeEpargneRepository::class)]
class TypeEpargne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomTypeEp = null;

    #[ORM\Column(length: 100)]
    private ?string $abreviation = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'typeEpargne', targetEntity: ProduitEpargne::class)]
    private Collection $TypeProduit;

    public function __construct()
    {
        $this->typeproduit = new ArrayCollection();
        $this->TypeProduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypeEp(): ?string
    {
        return $this->NomTypeEp;
    }

    public function setNomTypeEp(string $NomTypeEp): self
    {
        $this->NomTypeEp = $NomTypeEp;

        return $this;
    }

    public function getAbreviation(): ?string
    {
        return $this->abreviation;
    }

    public function setAbreviation(string $abreviation): self
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ProduitEpargne>
     */
    public function getTypeProduit(): Collection
    {
        return $this->TypeProduit;
    }

    public function addTypeProduit(ProduitEpargne $typeProduit): self
    {
        if (!$this->TypeProduit->contains($typeProduit)) {
            $this->TypeProduit[] = $typeProduit;
            $typeProduit->setTypeEpargne($this);
        }

        return $this;
    }

    public function removeTypeProduit(ProduitEpargne $typeProduit): self
    {
        if ($this->TypeProduit->removeElement($typeProduit)) {
            // set the owning side to null (unless already changed)
            if ($typeProduit->getTypeEpargne() === $this) {
                $typeProduit->setTypeEpargne(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

}
