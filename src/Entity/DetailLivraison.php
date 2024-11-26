<?php

namespace App\Entity;

use App\Repository\DetailLivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailLivraisonRepository::class)]
class DetailLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $quantite = null;

    #[ORM\OneToOne(inversedBy: 'id_detailLivraison', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?livraison $id_livraison = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'id_detailLivraison', orphanRemoval: true)]
    private Collection $id_produit;

    public function __construct()
    {
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

    public function getIdLivraison(): ?livraison
    {
        return $this -> id_livraison;
    }

    public function setIdLivraison(livraison $id_livraison): static
    {
        $this -> id_livraison = $id_livraison;

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
            $idProduit -> setIdDetailLivraison($this);
        }

        return $this;
    }

    public function removeIdProduit(produit $idProduit): static
    {
        if ($this -> id_produit -> removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit -> getIdDetailLivraison() === $this) {
                $idProduit -> setIdDetailLivraison(null);
            }
        }

        return $this;
    }

   
}
