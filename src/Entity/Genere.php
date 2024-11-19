<?php

namespace App\Entity;

use App\Repository\GenereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenereRepository::class)]
class Genere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $quantite = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'genere')]
    private Collection $produit;

    /**
     * @var Collection<int, livraison>
     */
    #[ORM\OneToMany(targetEntity: livraison::class, mappedBy: 'genere')]
    private Collection $livraison;

    public function __construct()
    {
        $this -> produit = new ArrayCollection();
        $this -> livraison = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getQuantite(): ?string
    {
        return $this -> quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this -> quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this -> produit;
    }

    public function addProduit(produit $produit): static
    {
        if (!$this -> produit -> contains($produit)) {
            $this -> produit -> add($produit);
            $produit -> setGenere($this);
        }

        return $this;
    }

    public function removeProduit(produit $produit): static
    {
        if ($this -> produit -> removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit -> getGenere() === $this) {
                $produit -> setGenere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, livraison>
     */
    public function getLivraison(): Collection
    {
        return $this -> livraison;
    }

    public function addLivraison(livraison $livraison): static
    {
        if (!$this -> livraison -> contains($livraison)) {
            $this -> livraison -> add($livraison);
            $livraison -> setGenere($this);
        }

        return $this;
    }

    public function removeLivraison(livraison $livraison): static
    {
        if ($this -> livraison -> removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison -> getGenere() === $this) {
                $livraison -> setGenere(null);
            }
        }

        return $this;
    }

    
}
