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

    // La relation entre produit et detail de la commande
    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'detailLivraison', orphanRemoval: true)]
    private Collection $produit;

    // La relation entre detail de la commande et la livraison
    /**
     * @var Collection<int, Livraison>
     */
    #[ORM\OneToMany(targetEntity: Livraison::class, mappedBy: 'detailLivraison', orphanRemoval: true)]
    private Collection $livraisons;

    // Le constructeur de la classe
    public function __construct()
    {
        $this->produit = new ArrayCollection();
        $this->livraisons = new ArrayCollection();
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

    // La relation entre produit et detail de la commande
    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this -> produit; // Retourne la collection des produits
    }

    // Ajoute un produit a la commande
    public function addProduit(Produit $Produit): static
    {
        // Si le produit n'existe pas dans la collection
        if (!$this -> produit -> contains($Produit)) {

            // Ajoute le produit a la collection
            $this -> produit -> add($Produit);

            // Lie le produit a la commande
            $Produit -> setDetailLivraison($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime un produit de la commande
    public function removeProduit(Produit $Produit): static
    {
        // Si le produit existe dans la collection
        if ($this -> produit -> removeElement($Produit)) {
            
            // Si le produit est lie a la commande
            if ($Produit -> getDetailLivraison() === $this) {

                // Lie le produit a null
                $Produit -> setDetailLivraison(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }

    // La relation entre detail de la commande et la livraison
    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this -> livraisons; // Retourne la collection des livraisons
    }

    // Ajoute une livraison a la commande
    public function addLivraison(Livraison $livraison): static
    {
        // Si la livraison n'existe pas dans la collection
        if (!$this -> livraisons -> contains($livraison)) {

            // Ajoute la livraison a la collection
            $this -> livraisons -> add($livraison);

            // Lie la livraison a la commande
            $livraison -> setDetailLivraison($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime une livraison de la commande
    public function removeLivraison(Livraison $livraison): static
    {
        // Si la livraison existe dans la collection
        if ($this -> livraisons -> removeElement($livraison)) {

            // Si la livraison est lie a la commande
            if ($livraison -> getDetailLivraison() === $this) {

                // Lie la livraison a null
                $livraison -> setDetailLivraison(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }
   
}
