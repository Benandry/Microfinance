<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomGroupe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(length: 50)]
    private ?string $numeroMobile = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'MembreGroupe', targetEntity: Individuelclient::class)]
    private Collection $IndividuelMembre;

    #[ORM\OneToMany(mappedBy: 'codegroupe', targetEntity: ListeRouge::class)]
    private Collection $listeRouges;

    #[ORM\OneToMany(mappedBy: 'codeGroupe', targetEntity: CompteEpargne::class)]
    private Collection $codegroupeEpargne;

    #[ORM\OneToMany(mappedBy: 'codegroupetransaction', targetEntity: Transaction::class)]
    private Collection $transactions;

    #[ORM\Column(length: 255)]
    private ?string $codegroupe = null;


    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->membreGroupes = new ArrayCollection();
        $this->GroupeNom = new ArrayCollection();
        $this->IndividuelMembre = new ArrayCollection();
        $this->listeRouges = new ArrayCollection();
        $this->codegroupeEpargne = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGroupe(): ?string
    {
        return $this->nomGroupe;
    }

    public function setNomGroupe(string $nomGroupe): self
    {
        $this->nomGroupe = $nomGroupe;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getNumeroMobile(): ?string
    {
        return $this->numeroMobile;
    }

    public function setNumeroMobile(string $numeroMobile): self
    {
        $this->numeroMobile = $numeroMobile;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return Collection<int, Individuelclient>
     */
    public function getIndividuelMembre(): Collection
    {
        return $this->IndividuelMembre;
    }

    public function addIndividuelMembre(Individuelclient $individuelMembre): self
    {
        if (!$this->IndividuelMembre->contains($individuelMembre)) {
            $this->IndividuelMembre[] = $individuelMembre;
            $individuelMembre->setMembreGroupe($this);
        }

        return $this;
    }

    public function removeIndividuelMembre(Individuelclient $individuelMembre): self
    {
        if ($this->IndividuelMembre->removeElement($individuelMembre)) {
            // set the owning side to null (unless already changed)
            if ($individuelMembre->getMembreGroupe() === $this) {
                $individuelMembre->setMembreGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ListeRouge>
     */
    public function getListeRouges(): Collection
    {
        return $this->listeRouges;
    }

    public function addListeRouge(ListeRouge $listeRouge): self
    {
        if (!$this->listeRouges->contains($listeRouge)) {
            $this->listeRouges[] = $listeRouge;
            $listeRouge->setCodegroupe($this);
        }

        return $this;
    }

    public function removeListeRouge(ListeRouge $listeRouge): self
    {
        if ($this->listeRouges->removeElement($listeRouge)) {
            // set the owning side to null (unless already changed)
            if ($listeRouge->getCodegroupe() === $this) {
                $listeRouge->setCodegroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteEpargne>
     */
    public function getCodegroupeEpargne(): Collection
    {
        return $this->codegroupeEpargne;
    }

    public function addCodegroupeEpargne(CompteEpargne $codegroupeEpargne): self
    {
        if (!$this->codegroupeEpargne->contains($codegroupeEpargne)) {
            $this->codegroupeEpargne[] = $codegroupeEpargne;
            $codegroupeEpargne->setCodeGroupe($this);
        }

        return $this;
    }

    public function removeCodegroupeEpargne(CompteEpargne $codegroupeEpargne): self
    {
        if ($this->codegroupeEpargne->removeElement($codegroupeEpargne)) {
            // set the owning side to null (unless already changed)
            if ($codegroupeEpargne->getCodeGroupe() === $this) {
                $codegroupeEpargne->setCodeGroupe(null);
            }
        }

        return $this;
    }

    public function getCodegroupe(): ?string
    {
        return $this->codegroupe;
    }

    public function setCodegroupe(string $codegroupe): self
    {
        $this->codegroupe = $codegroupe;

        return $this;
    }

}
