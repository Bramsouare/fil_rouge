<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\DetailLivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: DetailLivraisonRepository::class)]
class DetailLivraison
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
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'detailLivraison', orphanRemoval: true)]
    private Collection $produit;

    #[ORM\ManyToOne(inversedBy: 'detailLivraison')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livraison $livraison = null;

    public function __construct()
    {
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
            $Produit -> setDetailLivraison($this);
        }

        return $this;
    }

    public function removeProduit(Produit $Produit): static
    {
        if ($this -> produit -> removeElement($Produit)) {
            // set the owning side to null (unless already changed)
            if ($Produit -> getDetailLivraison() === $this) {
                $Produit -> setDetailLivraison(null);
            }
        }

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }

   
}
