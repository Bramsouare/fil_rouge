<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\DetailLivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: DetailLivraisonRepository::class)]
class DetailLivraison
{
    // Clés primaires de l'entité
    #[ORM\Id]
    // Valeur auto incrementé
    #[ORM\GeneratedValue]
    //Colonne dans la base de données
    #[ORM\Column]
    // L'id de la commande
    private ?int $id = null;

    // La quantité de la commande
    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'detailLivraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'detailLivraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?livraison $livraison = null;

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
        return $this -> quantite; // Retourne la quantité de la commande
    }

    public function setQuantite(string $quantite): static
    {
        $this -> quantite = $quantite; // Modifie la quantité de la commande

        return $this; // Retourne l'objet actuel
    }

    public function getProduit(): ?produit
    {
        return $this->produit;
    }

    public function setProduit(?produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getLivraison(): ?livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?livraison $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }

    
   
}
