<?php

namespace App\Entity;

use App\Entity\Utilisateur;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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
    private ?tva $tva = null;


    #[ORM\ManyToOne(inversedBy: 'id_produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rubrique $id_rubrique = null;

    #[ORM\ManyToOne(inversedBy: 'id_produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $id_fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'id_produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $id_utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'id_produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $id_commande = null;

    #[ORM\ManyToOne(inversedBy: 'id_produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DetailCommande $id_detailCommande = null;

    #[ORM\ManyToOne(inversedBy: 'id_produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DetailLivraison $id_detailLivraison = null;

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

    public function getTva(): ?tva
    {
        return $this -> tva;
    }

    public function setTva(?tva $tva): static
    {
        $this -> tva = $tva;

        return $this;
    }

    public function getIdRubrique(): ?Rubrique
    {
        return $this -> id_rubrique;
    }

    public function setIdRubrique(?Rubrique $id_rubrique): static
    {
        $this -> id_rubrique = $id_rubrique;

        return $this;
    }

    public function getIdFournisseur(): ?Fournisseur
    {
        return $this -> id_fournisseur;
    }

    public function setIdFournisseur(?Fournisseur $id_fournisseur): static
    {
        $this -> id_fournisseur = $id_fournisseur;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this -> id_utilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $id_utilisateur): static
    {
        $this -> id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this -> id_commande;
    }

    public function setIdCommande(?Commande $id_commande): static
    {
        $this -> id_commande = $id_commande;

        return $this;
    }

    public function getIdDetailCommande(): ?DetailCommande
    {
        return $this -> id_detailCommande;
    }

    public function setIdDetailCommande(?DetailCommande $id_detailCommande): static
    {
        $this -> id_detailCommande = $id_detailCommande;

        return $this;
    }

    public function getIdDetailLivraison(): ?DetailLivraison
    {
        return $this -> id_detailLivraison;
    }

    public function setIdDetailLivraison(?DetailLivraison $id_detailLivraison): static
    {
        $this -> id_detailLivraison = $id_detailLivraison;

        return $this;
    }
}
