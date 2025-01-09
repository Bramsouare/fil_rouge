<?php

namespace App\Entity;

use App\Entity\Produit;
use App\Entity\Commande;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\DetailCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données
#[ORM\Entity(repositoryClass: DetailCommandeRepository::class)]
class DetailCommande
{
    // Cléf primaire de l'entité
    #[ORM\Id]
    // L'id de la commande est auto-increment
    #[ORM\GeneratedValue]
    // L'id de la commande est unique
    #[ORM\Column]
    // L'id de la commande
    private ?int $id = null;

    // La quantite de la commande
    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $quantite = null;

    // Le prix de vente de la commande
    #[ORM\Column(type: Types::DECIMAL, precision: 19, scale: 4)]
    private ?string $prix_de_vente = null;

    #[ORM\ManyToOne(inversedBy: 'detailCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'detailCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    // Le constructeur de la classe 
    public function __construct()
    {
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################
    
    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id de la commande
    }

    public function getQuantite(): ?string
    {
        return $this -> quantite; // Retourne la quantite de la commande
    }

    public function setQuantite(string $quantite): static
    {
        $this -> quantite = $quantite; // Modifie la quantite de la commande

        return $this; // Retourne l'objet actuel
    }

    public function getPrixDeVente(): ?string
    {
        return $this -> prix_de_vente; // Retourne le prix de vente de la commande
    }

    public function setPrixDeVente(string $prix_de_vente): static
    {
        $this -> prix_de_vente = $prix_de_vente; // Modifie le prix de vente de la commande

        return $this; // Retourne l'objet actuel
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

}
