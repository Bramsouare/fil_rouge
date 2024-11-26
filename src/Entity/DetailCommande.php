<?php

namespace App\Entity;

use App\Repository\DetailCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailCommandeRepository::class)]
class DetailCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?float $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 19, scale: 4)]
    private ?float $prix_de_vente = null;

    #[ORM\ManyToOne(inversedBy: 'detail_commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?commande $commande = null;

    #[ORM\OneToOne(inversedBy: 'id_detailCommande', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?commande $id_commande = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'id_detailCommande', orphanRemoval: true)]
    private Collection $id_produit;

    public function __construct()
    {
        $this -> commande = new ArrayCollection();
        $this->id_produit = new ArrayCollection();
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

    public function getIdCommande(): ?commande
    {
        return $this -> id_commande;
    }

    public function setIdCommande(commande $id_commande): static
    {
        $this -> id_commande = $id_commande;

        return $this;
    }

    /**
     * @return Collection<int, produit>
     */
    public function getIdProduit(): Collection
    {
        return $this -> id_produit;
    }

    public function addIdProduit(produit $idProduit): static
    {
        if (!$this -> id_produit -> contains($idProduit)) {
            $this -> id_produit -> add($idProduit);
            $idProduit -> setIdDetailCommande($this);
        }

        return $this;
    }

    public function removeIdProduit(produit $idProduit): static
    {
        if ($this -> id_produit -> removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit -> getIdDetailCommande() === $this) {
                $idProduit -> setIdDetailCommande(null);
            }
        }

        return $this;
    }

}
