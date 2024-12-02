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

    // Le produit de la commande
    #[ORM\OneToOne(inversedBy: 'detailCommande', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    // Les produits de la commande
    /**
     * @var Collection<int, produit>
     */
    // Relation entre la commande et le produit
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'detailCommande', orphanRemoval: true)]
    private Collection $produit;

    // Le constructeur de la classe 
    public function __construct()
    {
        $this -> commande = new ArrayCollection();
        $this -> produit = new ArrayCollection();
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


    public function getCommande(): ?Commande
    {
        return $this -> commande; // Retourne la commande
    }

    public function setCommande(Commande $commande): static
    {
        $this -> commande = $commande; // Modifie la commande

        return $this; // Retourne l'objet actuel
    }

    // Relation entre la commande et le produit
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
            $Produit -> setDetailCommande($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime un produit de la commande
    public function removeProduit(Produit $Produit): static
    {
        // Si le produit existe dans la collection
        if ($this -> produit -> removeElement($Produit)) {
            
            // Si le produit est lie a la commande
            if ($Produit -> getDetailCommande() === $this) {

                // Lie le produit a null
                $Produit -> setDetailCommande(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }

}
