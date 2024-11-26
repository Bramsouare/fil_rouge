<?php

namespace App\Entity;

use App\Entity\Utilisateur;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $produit_libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $produit_description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?float $produit_prix_ht = null;

    #[ORM\Column(length: 255)]
    private ?string $produit_reference = null;

    #[ORM\Column(length: 255)]
    private ?string $produit_image = null;

    #[ORM\Column]
    private ?bool $produit_actif = null;

    #[ORM\Column(length: 255)]
    private ?string $produit_stock = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tva $tva = null;


    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rubrique $rubrique = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DetailCommande $detailCommande = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DetailLivraison $detailLivraison = null;

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getProduitLibelle(): ?string
    {
        return $this -> produit_libelle;
    }

    public function setProduitLibelle(string $produit_libelle): static
    {
        $this -> produit_libelle = $produit_libelle;

        return $this;
    }

    public function getProduitDescription(): ?string
    {
        return $this -> produit_description;
    }

    public function setProduitDescription(string $produit_description): static
    {
        $this -> produit_description = $produit_description;

        return $this;
    }

    public function getProduitPrixHt(): ?string
    {
        return $this -> produit_prix_ht;
    }

    public function setProduitPrixHt(string $produit_prix_ht): static
    {
        $this -> produit_prix_ht = $produit_prix_ht;

        return $this;
    }

    public function getProduitReference(): ?string
    {
        return $this -> produit_reference;
    }

    public function setProduitReference(string $produit_reference): static
    {
        $this -> produit_reference = $produit_reference;

        return $this;
    }

    public function getProduitImage(): ?string
    {
        return $this -> produit_image;
    }

    public function setProduitImage(string $produit_image): static
    {
        $this -> produit_image = $produit_image;

        return $this;
    }

    public function isProduitActif(): ?bool
    {
        return $this -> produit_actif;
    }

    public function setProduitActif(bool $produit_actif): static
    {
        $this -> produit_actif = $produit_actif;

        return $this;
    }

    public function getProduitStock(): ?string
    {
        return $this -> produit_stock;
    }

    public function setProduitStock(string $produit_stock): static
    {
        $this -> produit_stock = $produit_stock;

        return $this;
    }

    public function getTva(): ?Tva
    {
        return $this -> tva;
    }

    public function setTva(?Tva $tva): static
    {
        $this -> tva = $tva;

        return $this;
    }

    public function getRubrique(): ?Rubrique
    {
        return $this -> rubrique;
    }

    public function setRubrique(?Rubrique $rubrique): static
    {
        $this -> rubrique = $rubrique;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this -> fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this -> fournisseur = $fournisseur;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this -> utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this -> utilisateur = $utilisateur;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this -> commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this -> commande = $commande;

        return $this;
    }

    public function getDetailCommande(): ?DetailCommande
    {
        return $this -> detailCommande;
    }

    public function setDetailCommande(?DetailCommande $detailCommande): static
    {
        $this -> detailCommande = $detailCommande;

        return $this;
    }

    public function getDetailLivraison(): ?DetailLivraison
    {
        return $this -> detailLivraison;
    }

    public function setDetailLivraison(?DetailLivraison $detailLivraison): static
    {
        $this -> detailLivraison = $detailLivraison;

        return $this;
    }
}
