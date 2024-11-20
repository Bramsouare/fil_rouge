<?php

namespace App\Entity;

use App\Repository\DetailLivraisonRepository;
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

    #[ORM\ManyToOne(inversedBy: 'detailLivraison')]
    #[ORM\JoinColumn(nullable: false)]
    private ?livraison $id_livraison = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?produit $id_produit = null;

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

    public function setIdLivraison(?livraison $id_livraison): static
    {
        $this -> id_livraison = $id_livraison;

        return $this;
    }

    public function getIdProduit(): ?produit
    {
        return $this -> id_produit;
    }

    public function setIdProduit(?produit $id_produit): static
    {
        $this -> id_produit = $id_produit;

        return $this;
    }
}
