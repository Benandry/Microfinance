<?php

namespace App\Entity;

use App\Repository\PlanComptableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanComptableRepository::class)]
class PlanComptable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NumeroCompte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Libelle = null;

    #[ORM\OneToMany(mappedBy: 'Caisse', targetEntity: RemboursementCredit::class)]
    private Collection $remboursementCredits;

    public function __construct()
    {
        $this->remboursementCredits = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompte(): ?string
    {
        return $this->NumeroCompte;
    }

    public function setNumeroCompte(?string $NumeroCompte): self
    {
        $this->NumeroCompte = $NumeroCompte;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(?string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    /**
     * @return Collection<int, RemboursementCredit>
     */
    public function getRemboursementCredits(): Collection
    {
        return $this->remboursementCredits;
    }

    public function addRemboursementCredit(RemboursementCredit $remboursementCredit): self
    {
        if (!$this->remboursementCredits->contains($remboursementCredit)) {
            $this->remboursementCredits->add($remboursementCredit);
            $remboursementCredit->setCaisse($this);
        }

        return $this;
    }

    public function removeRemboursementCredit(RemboursementCredit $remboursementCredit): self
    {
        if ($this->remboursementCredits->removeElement($remboursementCredit)) {
            // set the owning side to null (unless already changed)
            if ($remboursementCredit->getCaisse() === $this) {
                $remboursementCredit->setCaisse(null);
            }
        }

        return $this;
    }

}
