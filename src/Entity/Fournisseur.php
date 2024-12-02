<?php

namespace App\Entity;

use App\Entity\Adresse;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    // Clés primaire de l'entité
    #[ORM\Id]
    // Valeur auto-incrémenté
    #[ORM\GeneratedValue]
    // Colonne de la table
    #[ORM\Column]
    // Identifiant de l'entité
    private ?int $id = null;

    // Numéro de SIRET
    #[ORM\Column(length: 255)]
    private ?string $fournisseur_siret = null;

    // Nom du fournisseur
    #[ORM\Column(length: 255)]
    private ?string $fournisseur_nom = null;

    // Telephone du fournisseur
    #[ORM\Column(length: 255)]
    private ?string $fournisseur_telephone = null;

    // Email du fournisseur
    #[ORM\Column(length: 255)]
    private ?string $fournisseur_mail = null;

    // Constructeur
    #[ORM\Column]
    private ?bool $fournisseur_constructeur = null;

    // Adresse du fournisseur
    /**
     * @var Collection<int, Adresse>
     */
    // Relation avec l'entité Adresse
    #[ORM\OneToMany(targetEntity: Adresse::class, mappedBy: 'fournisseur', orphanRemoval: true)]
    private Collection $adresse;

    // Produit du fournisseur
    /**
     * @var Collection<int, produit>
     */
    // Relation avec l'entité Produit
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'fournisseur', orphanRemoval: true)]
    private Collection $produit;

    // Relation avec l'entité Utilisateur
    #[ORM\OneToOne(inversedBy: 'fournisseur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    // Constructeur
    public function __construct()
    {
        $this -> adresse = new ArrayCollection();
        $this -> produit = new ArrayCollection();
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################
    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id du fournisseur
    }

    public function getFournisseurSiret(): ?string
    {
        return $this -> fournisseur_siret; // Retourne le SIRET du fournisseur
    }

    public function setFournisseurSiret(string $fournisseur_siret): static
    {
        $this -> fournisseur_siret = $fournisseur_siret; // Modifie le SIRET du fournisseur

        return $this; // Retourne l'objet actuel
    }

    public function getFournisseurNom(): ?string
    {
        return $this -> fournisseur_nom; // Retourne le nom du fournisseur
    }

    public function setFournisseurNom(string $fournisseur_nom): static
    {
        $this -> fournisseur_nom = $fournisseur_nom; // Modifie le nom du fournisseur

        return $this; // Retourne l'objet actuel
    }

    public function getFournisseurTelephone(): ?string
    {
        return $this -> fournisseur_telephone; // Retourne le telephone du fournisseur
    }

    public function setFournisseurTelephone(string $fournisseur_telephone): static
    {
        $this -> fournisseur_telephone = $fournisseur_telephone; // Modifie le telephone du fournisseur

        return $this; // Retourne l'objet actuel
    }

    public function getFournisseurMail(): ?string
    {
        return $this -> fournisseur_mail; // Retourne l'email du fournisseur
    }

    public function setFournisseurMail(string $fournisseur_mail): static
    {
        $this -> fournisseur_mail = $fournisseur_mail; // Modifie l'email du fournisseur

        return $this; // Retourne l'objet actuel
    }

    // Constructeur du fournisseur 
    public function isFournisseurConstructeur(): ?bool
    {
        return $this -> fournisseur_constructeur; // Retourne le constructeur du fournisseur
    }

    public function setFournisseurConstructeur(bool $fournisseur_constructeur): static
    {
        $this -> fournisseur_constructeur = $fournisseur_constructeur; // Modifie le constructeur du fournisseur

        return $this; // Retourne l'objet actuel
    }

    
    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresse(): Collection
    {
        return $this -> adresse; // Retourne les adresses du fournisseur
    }

    // Ajoute une adresse au fournisseur
    public function addAdresse(Adresse $Adresse): static
    {
        // Si l'adresse n'existe pas dans la collection
        if (!$this -> adresse -> contains($Adresse)) {

            // Ajoute l'adresse a la collection
            $this -> adresse -> add($Adresse);

            // Lie l'adresse au fournisseur
            $Adresse -> setFournisseur($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime une adresse du fournisseur
    public function removeAdresse(Adresse $Adresse): static
    {
        // Supprime l'adresse de la collection
        if ($this -> adresse -> removeElement($Adresse)) {
            
            // Si l'adresse est liée au fournisseur
            if ($Adresse -> getFournisseur() === $this) {

                // Lie l'adresse a null
                $Adresse -> setFournisseur(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this -> produit; // Retourne la collection des produits
    }

    // Ajoute un produit au fournisseur
    public function addProduit(Produit $Produit): static
    {
        // Si le produit n'existe pas dans la collection
        if (!$this -> produit -> contains($Produit)) {

            // Ajoute le produit a la collection
            $this -> produit -> add($Produit);

            // Lie le produit au fournisseur
            $Produit -> setFournisseur($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime un produit du fournisseur
    public function removeProduit(Produit $Produit): static
    {
        // Supprime le produit de la collection
        if ($this -> produit -> removeElement($Produit)) {
            
            // Si le produit est lié au fournisseur
            if ($Produit -> getFournisseur() === $this) {

                // Lie le produit a null
                $Produit -> setFournisseur(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }


    public function getUtilisateur(): ?Utilisateur
    {
        return $this -> utilisateur; // Retourne l'utilisateur 
    }

    public function setUtilisateur(Utilisateur $utilisateur): static
    {
        $this -> utilisateur = $utilisateur; // Modifie l'utilisateur

        return $this; // Retourne l'objet actuel
    }
}
