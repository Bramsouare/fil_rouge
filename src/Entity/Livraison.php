<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $livraison_statut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $livraison_date = null;

    #[ORM\Column(length: 255)]
    private ?string $livraison_reference = null;

    /**
     * @var Collection<int, commande>
     */
    #[ORM\OneToMany(targetEntity: commande::class, mappedBy: 'livraison')]
    private Collection $commande;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\ManyToMany(targetEntity: produit::class, inversedBy: 'livraisons')]
    private Collection $produit;

    /**
     * @var Collection<int, Genere>
     */
    #[ORM\ManyToMany(targetEntity: Genere::class, mappedBy: 'produit')]
    private Collection $generes;

    #[ORM\ManyToOne(inversedBy: 'livraison')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genere $genere = null;

    public function __construct()
    {
        $this -> commande = new ArrayCollection();
        $this -> produit = new ArrayCollection();
        $this -> generes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getLivraisonStatut(): ?string
    {
        return $this -> livraison_statut;
    }

    public function setLivraisonStatut(string $livraison_statut): static
    {
        $this -> livraison_statut = $livraison_statut;

        return $this;
    }

    public function getLivraisonDate(): ?\DateTimeInterface
    {
        return $this -> livraison_date;
    }

    public function setLivraisonDate(\DateTimeInterface $livraison_date): static
    {
        $this -> livraison_date = $livraison_date;

        return $this;
    }

    public function getLivraisonReference(): ?string
    {
        return $this -> livraison_reference;
    }

    public function setLivraisonReference(string $livraison_reference): static
    {
        $this -> livraison_reference = $livraison_reference;

        return $this;
    }

    /**
     * @return Collection<int, commande>
     */
    public function getCommande(): Collection
    {
        return $this -> commande;
    }

    public function addCommande(commande $commande): static
    {
        if (!$this -> commande -> contains($commande)) {
            $this -> commande -> add($commande);
            $commande -> setLivraison($this);
        }

        return $this;
    }

    public function removeCommande(commande $commande): static
    {
        if ($this -> commande -> removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande -> getLivraison() === $this) {
                $commande -> setLivraison(null);
            }
        }

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
        }

        return $this;
    }

    public function removeProduit(produit $produit): static
    {
        $this -> produit -> removeElement($produit);

        return $this;
    }

    /**
     * @return Collection<int, Genere>
     */
    public function getGeneres(): Collection
    {
        return $this -> generes;
    }

    public function addGenere(Genere $genere): static
    {
        if (!$this -> generes -> contains($genere)) {
            $this -> generes -> add($genere);
            $genere -> addProduit($this);
        }

        return $this;
    }

    public function removeGenere(Genere $genere): static
    {
        if ($this -> generes -> removeElement($genere)) {
            $genere -> removeProduit($this);
        }

        return $this;
    }

    public function getGenere(): ?Genere
    {
        return $this -> genere;
    }

    public function setGenere(?Genere $genere): static
    {
        $this -> genere = $genere;

        return $this;
    }
}
