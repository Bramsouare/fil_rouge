<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RubriqueRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: RubriqueRepository::class)]
class Rubrique
{
    // Clef primaire de l'entité
    #[ORM\Id]
    // Valeur auto-incrementé
    #[ORM\GeneratedValue]
    // Colonne de la table
    #[ORM\Column]
    // Identifiant de l'entité
    private ?int $id = null;

    // Colonne rubrique_libelle
    #[ORM\Column(length: 255)]
    private ?string $rubrique_libelle = null;

    // Colonne rubrique_image
    #[ORM\Column(length: 255)]
    private ?string $rubrique_image = null;

    // Colonne rubrique_description
    #[ORM\Column(length: 255)]
    private ?string $rubrique_description = null;

    /**
     * @var Collection<int, produit>
     */
    // Relation entre la rubrique et le produit
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'rubrique', orphanRemoval: true)]
    private Collection $produit;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'parent')]
    #[ORM\JoinColumn(nullable: true)]
    private ?self $rubrique = null;

    // Constructeur
    public function __construct()
    {
        $this -> produit = new ArrayCollection();
    }

    
    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################
    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id de la rubrique
    }

    public function getRubriqueLibelle(): ?string
    {
        return $this -> rubrique_libelle; // Retourne le libelle de la rubrique
    }

    public function setRubriqueLibelle(string $rubrique_libelle): static
    {
        $this -> rubrique_libelle = $rubrique_libelle; // Modifie le libelle de la rubrique

        return $this; // Retourne l'objet actuel
    }

    public function getRubriqueImage(): ?string
    {
        return $this -> rubrique_image; // Retourne l'image de la rubrique
    }

    public function setRubriqueImage(string $rubrique_image): static
    {
        $this -> rubrique_image = $rubrique_image; // Modifie l'image de la rubrique

        return $this; // Retourne l'objet actuel
    }

    public function getRubriqueDescription(): ?string
    {
        return $this -> rubrique_description; // Retourne la description de la rubrique
    }

    public function setRubriqueDescription(string $rubrique_description): static
    {
        $this -> rubrique_description = $rubrique_description; // Modifie la description de la rubrique

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this -> produit; // Retourne la collection des produits
    }

    // Ajoute un produit au rubrique
    public function addProduit(Produit $idProduit): static
    {
        // Si le produit n'existe pas dans la collection
        if (!$this -> produit -> contains($idProduit)) {

            // Ajoute le produit a la collection
            $this -> produit -> add($idProduit);

            // Modifie la rubrique du produit
            $idProduit -> setRubrique($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime un produit du rubrique
    public function removeProduit(Produit $idProduit): static
    {
        // Supprime le produit de la collection
        if ($this -> produit -> removeElement($idProduit)) {
            
            // Modifie la rubrique du produit
            if ($idProduit -> getRubrique() === $this) {

                // Modifie la rubrique du produit
                $idProduit -> setRubrique(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }

    public function getRubrique(): ?self
    {
        return $this->rubrique;
    }

    public function setRubrique(?self $rubrique): static
    {
        $this->rubrique = $rubrique;

        return $this;
    }
}
