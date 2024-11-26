<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    #[ORM\OneToMany(targetEntity: Adresse::class, mappedBy: 'id_fournisseur', orphanRemoval: true)]
    private Collection $id_adresse;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'id_fournisseur', orphanRemoval: true)]
    private Collection $id_produit;

    #[ORM\OneToOne(inversedBy: 'id_fournisseur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?utilisateur $id_utilisateur = null;

    public function __construct()
    {
        $this -> id_adresse = new ArrayCollection();
        $this -> id_produit = new ArrayCollection();
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
    public function getIdAdresse(): Collection
    {
        return $this -> id_adresse;
    }

    public function addIdAdresse(Adresse $idAdresse): static
    {
        if (!$this -> id_adresse -> contains($idAdresse)) {
            $this -> id_adresse -> add($idAdresse);
            $idAdresse -> setIdFournisseur($this);
        }

        return $this;
    }

    public function removeIdAdresse(Adresse $idAdresse): static
    {
        if ($this -> id_adresse -> removeElement($idAdresse)) {
            // set the owning side to null (unless already changed)
            if ($idAdresse -> getIdFournisseur() === $this) {
                $idAdresse -> setIdFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, produit>
     */
    public function getIdProduit(): Collection
    {
        return $this -> id_produit;
    }

    public function addIdProduit(produit $idProduit): static
    {
        if (!$this -> id_produit -> contains($idProduit)) {
            $this -> id_produit -> add($idProduit);
            $idProduit -> setIdFournisseur($this);
        }

        return $this;
    }

    public function removeIdProduit(produit $idProduit): static
    {
        if ($this -> id_produit -> removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit -> getIdFournisseur() === $this) {
                $idProduit -> setIdFournisseur(null);
            }
        }

        return $this;
    }

    public function getIdUtilisateur(): ?utilisateur
    {
        return $this -> id_utilisateur;
    }

    public function setIdUtilisateur(utilisateur $id_utilisateur): static
    {
        $this -> id_utilisateur = $id_utilisateur;

        return $this;
    }
}
