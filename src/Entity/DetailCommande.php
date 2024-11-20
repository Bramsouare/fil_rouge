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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?produit $id_produit = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?commande $id_commande = null;


  

    public function __construct()
    {
        $this -> commande = new ArrayCollection();
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

    public function getIdProduit(): ?produit
    {
        return $this->id_produit;
    }

    public function setIdProduit(?produit $id_produit): static
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getIdCommande(): ?commande
    {
        return $this->id_commande;
    }

    public function setIdCommande(?commande $id_commande): static
    {
        $this->id_commande = $id_commande;

        return $this;
    }


}
