<?php

namespace App\Entity;

use App\Repository\TvaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TvaRepository::class)]
class Tva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $tva_taux = null;

    // /**
    //  * @var Collection<int, Produit>
    //  */
    // #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'tva')]
    // private Collection $produits;

    // public function __construct()
    // {
    //     $this->produits = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getTvaTaux(): ?string
    {
        return $this -> tva_taux;
    }

    public function setTvaTaux(string $tva_taux): static
    {
        $this -> tva_taux = $tva_taux;

        return $this;
    }

    // /**
    //  * @return Collection<int, Produit>
    //  */
    // public function getProduits(): Collection
    // {
    //     return $this->produits;
    // }

    // public function addProduit(Produit $produit): static
    // {
    //     if (!$this->produits->contains($produit)) {
    //         $this->produits->add($produit);
    //         $produit->setTva($this);
    //     }

    //     return $this;
    // }

    // public function removeProduit(Produit $produit): static
    // {
    //     if ($this->produits->removeElement($produit)) {
    //         // set the owning side to null (unless already changed)
    //         if ($produit->getTva() === $this) {
    //             $produit->setTva(null);
    //         }
    //     }

    //     return $this;
    // }
}
