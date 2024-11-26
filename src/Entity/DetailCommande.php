<?php

namespace App\Entity;

use App\Entity\Produit;
use App\Entity\Commande;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\DetailCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: DetailCommandeRepository::class)]
class DetailCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 19, scale: 4)]
    private ?string $prix_de_vente = null;

    #[ORM\OneToOne(inversedBy: 'detailCommande', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'detailCommande', orphanRemoval: true)]
    private Collection $produit;

    public function __construct()
    {
        $this -> commande = new ArrayCollection();
        $this->produit = new ArrayCollection();
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


    public function getCommande(): ?Commande
    {
        return $this -> commande;
    }

    public function setCommande(Commande $commande): static
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

    public function addProduit(Produit $Produit): static
    {
        if (!$this -> produit -> contains($Produit)) {
            $this -> produit -> add($Produit);
            $Produit -> setDetailCommande($this);
        }

        return $this;
    }

    public function removeProduit(Produit $Produit): static
    {
        if ($this -> produit -> removeElement($Produit)) {
            // set the owning side to null (unless already changed)
            if ($Produit -> getDetailCommande() === $this) {
                $Produit -> setDetailCommande(null);
            }
        }

        return $this;
    }

}
