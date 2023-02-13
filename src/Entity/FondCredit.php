<?php

namespace App\Entity;

use App\Repository\FondCreditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FondCreditRepository::class)]
class FondCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NomBailleurs = null;

    #[ORM\Column(nullable: true)]
    private ?float $Montant = null;

    #[ORM\ManyToOne(inversedBy: 'fondCredits')]
    private ?Devise $devise = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'FondCredit', targetEntity: DemandeCredit::class)]
    private Collection $demandeCredits;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $NumeroCompte = null;

    public function __construct()
    {
        $this->demandeCredits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBailleurs(): ?string
    {
        return $this->NomBailleurs;
    }

    public function setNomBailleurs(?string $NomBailleurs): self
    {
        $this->NomBailleurs = $NomBailleurs;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(?float $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getDevise(): ?Devise
    {
        return $this->devise;
    }

    public function setDevise(?Devise $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     */
    // public function getDemandeCredits(): Collection
    // {
    //     return $this->demandeCredits;
    // }

    // public function addDemandeCredit(DemandeCredit $demandeCredit): self
    // {
    //     if (!$this->demandeCredits->contains($demandeCredit)) {
    //         $this->demandeCredits[] = $demandeCredit;
    //         $demandeCredit->setFondCredit($this);
    //     }

    //     return $this;
    // }

    // public function removeDemandeCredit(DemandeCredit $demandeCredit): self
    // {
    //     if ($this->demandeCredits->removeElement($demandeCredit)) {
    //         // set the owning side to null (unless already changed)
    //         if ($demandeCredit->getFondCredit() === $this) {
    //             $demandeCredit->setFondCredit(null);
    //         }
    //     }

    //     return $this;
    // }

    public function __toString()
    {
        return $this->getId();
    }

    public function getNumeroCompte(): ?string
    {
        return $this->NumeroCompte;
    }

    public function setNumeroCompte(string $NumeroCompte): self
    {
        $this->NumeroCompte = $NumeroCompte;

        return $this;
    }
}
