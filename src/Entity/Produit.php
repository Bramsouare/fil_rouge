<?php

namespace App\Entity;

use App\Entity\Utilisateur;
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

    // Relation entre la tva et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tva $tva = null;

    // Relation entre la rubrique et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rubrique $rubrique = null;

    // Relation entre le fournisseur et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    // Relation entre l'utilisateur et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    // Relation entre la commande et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    // Relation entre la commande et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DetailCommande $detailCommande = null;

    // Relation entre la livraison et le produit
    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DetailLivraison $detailLivraison = null;

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

    public function getTva(): ?Tva
    {
        return $this -> tva; // Retourne la tva du produit
    }

    public function setTva(?Tva $tva): static
    {
        $this -> tva = $tva; // Modifie la tva du produit

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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this -> utilisateur; // Retourne l'utilisateur du produit
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this -> utilisateur = $utilisateur; // Modifie l'utilisateur du produit

        return $this; // Retourne l'objet actuel
    }

    public function getCommande(): ?Commande
    {
        return $this -> commande; // Retourne la commande
    }

    public function setCommande(?Commande $commande): static
    {
        $this -> commande = $commande; // Modifie la commande

        return $this; // Retourne l'objet actuel
    }

    public function getDetailCommande(): ?DetailCommande
    {
        return $this -> detailCommande; // Retourne le detail de la commande
    }

    public function setDetailCommande(?DetailCommande $detailCommande): static
    {
        $this -> detailCommande = $detailCommande; // Modifie le detail de la commande

        return $this; // Retourne l'objet actuel
    }

    public function getDetailLivraison(): ?DetailLivraison
    {
        return $this -> detailLivraison; // Retourne le detail de la livraison
    }

    public function setDetailLivraison(?DetailLivraison $detailLivraison): static
    {
        $this -> detailLivraison = $detailLivraison; // Modifie le detail de la livraison

        return $this; // Retourne l'objet actuel
    }
}
