<?php

namespace App\Entity;

use App\Entity\Adresse;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur_siret = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur_nom = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur_telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur_mail = null;

    #[ORM\Column]
    private ?bool $fournisseur_constructeur = null;

    /**
     * @var Collection<int, Adresse>
     */
    #[ORM\OneToMany(targetEntity: Adresse::class, mappedBy: 'fournisseur', orphanRemoval: true)]
    private Collection $adresse;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'fournisseur', orphanRemoval: true)]
    private Collection $produit;

    #[ORM\OneToOne(inversedBy: 'fournisseur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    public function __construct()
    {
        $this -> adresse = new ArrayCollection();
        $this -> produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getFournisseurSiret(): ?string
    {
        return $this -> fournisseur_siret;
    }

    public function setFournisseurSiret(string $fournisseur_siret): static
    {
        $this -> fournisseur_siret = $fournisseur_siret;

        return $this;
    }

    public function getFournisseurNom(): ?string
    {
        return $this -> fournisseur_nom;
    }

    public function setFournisseurNom(string $fournisseur_nom): static
    {
        $this -> fournisseur_nom = $fournisseur_nom;

        return $this;
    }

    public function getFournisseurTelephone(): ?string
    {
        return $this -> fournisseur_telephone;
    }

    public function setFournisseurTelephone(string $fournisseur_telephone): static
    {
        $this -> fournisseur_telephone = $fournisseur_telephone;

        return $this;
    }

    public function getFournisseurMail(): ?string
    {
        return $this -> fournisseur_mail;
    }

    public function setFournisseurMail(string $fournisseur_mail): static
    {
        $this -> fournisseur_mail = $fournisseur_mail;

        return $this;
    }

    public function isFournisseurConstructeur(): ?bool
    {
        return $this -> fournisseur_constructeur;
    }

    public function setFournisseurConstructeur(bool $fournisseur_constructeur): static
    {
        $this -> fournisseur_constructeur = $fournisseur_constructeur;

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresse(): Collection
    {
        return $this -> adresse;
    }

    public function addAdresse(Adresse $Adresse): static
    {
        if (!$this -> adresse -> contains($Adresse)) {
            $this -> adresse -> add($Adresse);
            $Adresse -> setFournisseur($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $Adresse): static
    {
        if ($this -> adresse -> removeElement($Adresse)) {
            // set the owning side to null (unless already changed)
            if ($Adresse -> getFournisseur() === $this) {
                $Adresse -> setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this -> produit;
    }

    public function addProduit(Produit $Produit): static
    {
        if (!$this -> produit -> contains($Produit)) {
            $this -> produit -> add($Produit);
            $Produit -> setFournisseur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $Produit): static
    {
        if ($this -> produit -> removeElement($Produit)) {
            // set the owning side to null (unless already changed)
            if ($Produit -> getFournisseur() === $this) {
                $Produit -> setFournisseur(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this -> utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): static
    {
        $this -> utilisateur = $utilisateur;

        return $this;
    }
}
