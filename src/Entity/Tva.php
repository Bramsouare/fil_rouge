<?php

namespace App\Entity;

use App\Repository\TvaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: TvaRepository::class)]
class Tva
{
    // Clef primaire de l'entité
    #[ORM\Id]
    // Valeur auto-incrementé
    #[ORM\GeneratedValue]
    // Colonne correspondante en base de données
    #[ORM\Column]
    // L'identifiant de l'entité
    private ?int $id = null;

    // Colonne TVA_Taux 
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $tva_taux = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'tva', orphanRemoval: true)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################
    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id de la tva
    }

    public function getTvaTaux(): ?string
    {
        return $this -> tva_taux; // Retourne le taux de la tva
    }

    public function setTvaTaux(string $tva_taux): static
    {
        $this -> tva_taux = $tva_taux; // Modifie le taux de la tva

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setTva($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getTva() === $this) {
                $produit->setTva(null);
            }
        }

        return $this;
    }
}
