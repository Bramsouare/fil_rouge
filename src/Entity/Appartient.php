<?php

namespace App\Entity;

use App\Repository\AppartientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartientRepository::class)]
class Appartient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?float $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 19, scale: 4)]
    private ?float $prix_de_vente = null;

    #[ORM\ManyToOne(inversedBy: 'appartients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?commande $commande = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'appartient')]
    private Collection $produit;

  

    public function __construct()
    {
        $this -> commande = new ArrayCollection();
        $this -> produit = new ArrayCollection();
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

    public function getPrixDeVente(): ?string
    {
        return $this -> prix_de_vente;
    }

    public function setPrixDeVente(string $prix_de_vente): static
    {
        $this -> prix_de_vente = $prix_de_vente;

        return $this;
    }

    public function getCommande(): ?commande
    {
        return $this -> commande;
    }

    public function setCommande(?commande $commande): static
    {
        $this -> commande = $commande;

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
            $produit -> setAppartient($this);
        }

        return $this;
    }

    public function removeProduit(produit $produit): static
    {
        if ($this -> produit -> removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit -> getAppartient() === $this) {
                $produit -> setAppartient(null);
            }
        }

        return $this;
    }


}
