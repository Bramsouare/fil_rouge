<?php

namespace App\Entity;

use App\Entity\Utilisateur;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    // Clé primaire de l'entité
    #[ORM\Id]
    // Valeur auto-incrementé
    #[ORM\GeneratedValue]
    // Colonne de la table
    #[ORM\Column]
    // Retourne l'id du produit
    private ?int $id = null;

    // Libellé du produit
    #[ORM\Column(length: 255)]
    private ?string $produit_libelle = null;

    // Description du produit
    #[ORM\Column(type: Types::TEXT)]
    private ?string $produit_description = null;

    // Prix du produit
    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?float $produit_prix_ht = null;

    // Reference du produit
    #[ORM\Column(length: 255)]
    private ?string $produit_reference = null;

    // Image du produit
    #[ORM\Column(length: 255)]
    private ?string $produit_image = null;

    // Produit actif ou non 
    #[ORM\Column]
    private ?bool $produit_actif = null;

    // Stock du produit
    #[ORM\Column(length: 255)]
    private ?string $produit_stock = null;

    // Relation entre la rubrique et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rubrique $rubrique = null;

    // Relation entre le fournisseur et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'produit')]
    private Collection $utilisateurs;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tva $tva = null;

    /**
     * @var Collection<int, DetailCommande>
     */
    #[ORM\OneToMany(targetEntity: DetailCommande::class, mappedBy: 'produit', orphanRemoval: true)]
    private Collection $detailCommandes;

    /**
     * @var Collection<int, DetailLivraison>
     */
    #[ORM\OneToMany(targetEntity: DetailLivraison::class, mappedBy: 'produit', orphanRemoval: true)]
    private Collection $detailLivraisons;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->detailCommandes = new ArrayCollection();
        $this->detailLivraisons = new ArrayCollection();
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################
    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id du produit
    }

    public function getProduitLibelle(): ?string
    {
        return $this -> produit_libelle; // Retourne le libellé du produit
    }

    public function setProduitLibelle(string $produit_libelle): static
    {
        $this -> produit_libelle = $produit_libelle; // Modifie le libellé du produit

        return $this; // Retourne l'objet actuel
    }

    public function getProduitDescription(): ?string
    {
        return $this -> produit_description; // Retourne la description du produit
    }

    public function setProduitDescription(string $produit_description): static
    {
        $this -> produit_description = $produit_description; // Modifie la description du produit

        return $this; // Retourne l'objet actuel
    }

    public function getProduitPrixHt(): ?string
    {
        return $this -> produit_prix_ht; // Retourne le prix du produit
    }

    public function setProduitPrixHt(string $produit_prix_ht): static
    {
        $this -> produit_prix_ht = $produit_prix_ht; // Modifie le prix du produit

        return $this; // Retourne l'objet actuel
    }

    public function getProduitReference(): ?string
    {
        return $this -> produit_reference; // Retourne la reference du produit
    }

    public function setProduitReference(string $produit_reference): static
    {
        $this -> produit_reference = $produit_reference; // Modifie la reference du produit

        return $this; // Retourne l'objet actuel
    }

    public function getProduitImage(): ?string
    {
        return $this -> produit_image; // Retourne l'image du produit
    }

    public function setProduitImage(string $produit_image): static
    {
        $this -> produit_image = $produit_image; // Modifie l'image du produit

        return $this; // Retourne l'objet actuel
    }

    public function isProduitActif(): ?bool
    {
        return $this -> produit_actif; // Retourne l'actif du produit
    }

    public function setProduitActif(bool $produit_actif): static
    {
        $this -> produit_actif = $produit_actif; // Modifie l'actif du produit

        return $this; // Retourne l'objet actuel
    }

    public function getProduitStock(): ?string
    {
        return $this -> produit_stock; // Retourne le stock du produit
    }

    public function setProduitStock(string $produit_stock): static
    {
        $this -> produit_stock = $produit_stock; // Modifie le stock du produit

        return $this; // Retourne l'objet actuel
    }

    public function getRubrique(): ?Rubrique
    {
        return $this -> rubrique; // Retourne la rubrique du produit
    }

    public function setRubrique(?Rubrique $rubrique): static
    {
        $this -> rubrique = $rubrique; // Modifie la rubrique du produit

        return $this; // Retourne l'objet actuel
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this -> fournisseur; // Retourne le fournisseur du produit
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this -> fournisseur = $fournisseur; // Modifie le fournisseur du produit

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->addProduit($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            $utilisateur->removeProduit($this);
        }

        return $this;
    }

    public function getTva(): ?Tva
    {
        return $this->tva;
    }

    public function setTva(?Tva $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * @return Collection<int, DetailCommande>
     */
    public function getDetailCommandes(): Collection
    {
        return $this->detailCommandes;
    }

    public function addDetailCommande(DetailCommande $detailCommande): static
    {
        if (!$this->detailCommandes->contains($detailCommande)) {
            $this->detailCommandes->add($detailCommande);
            $detailCommande->setProduit($this);
        }

        return $this;
    }

    public function removeDetailCommande(DetailCommande $detailCommande): static
    {
        if ($this->detailCommandes->removeElement($detailCommande)) {
            // set the owning side to null (unless already changed)
            if ($detailCommande->getProduit() === $this) {
                $detailCommande->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetailLivraison>
     */
    public function getDetailLivraisons(): Collection
    {
        return $this->detailLivraisons;
    }

    public function addDetailLivraison(DetailLivraison $detailLivraison): static
    {
        if (!$this->detailLivraisons->contains($detailLivraison)) {
            $this->detailLivraisons->add($detailLivraison);
            $detailLivraison->setProduit($this);
        }

        return $this;
    }

    public function removeDetailLivraison(DetailLivraison $detailLivraison): static
    {
        if ($this->detailLivraisons->removeElement($detailLivraison)) {
            // set the owning side to null (unless already changed)
            if ($detailLivraison->getProduit() === $this) {
                $detailLivraison->setProduit(null);
            }
        }

        return $this;
    }
}
