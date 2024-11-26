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
     * @var Collection<int, DetailLivraison>
     */
    #[ORM\OneToMany(targetEntity: DetailLivraison::class, mappedBy: 'id_livraison', orphanRemoval: true)]
    private Collection $detailLivraison;

    #[ORM\ManyToOne(inversedBy: 'livraison')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $id_commande = null;

    #[ORM\OneToOne(mappedBy: 'id_livraison', cascade: ['persist', 'remove'])]
    private ?DetailLivraison $id_detailLivraison = null;


    public function __construct()
    {
        $this -> detailLivraison = new ArrayCollection();
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
     * @return Collection<int, DetailLivraison>
     */
    public function getDetailLivraison(): Collection
    {
        return $this -> detailLivraison;
    }

    public function getIdCommande(): ?Commande
    {
        return $this -> id_commande;
    }

    public function setIdCommande(?Commande $id_commande): static
    {
        $this -> id_commande = $id_commande;

        return $this;
    }

    public function getIdDetailLivraison(): ?DetailLivraison
    {
        return $this -> id_detailLivraison;
    }

    public function setIdDetailLivraison(DetailLivraison $id_detailLivraison): static
    {
        // set the owning side of the relation if necessary
        if ($id_detailLivraison -> getIdLivraison() !== $this) {
            $id_detailLivraison -> setIdLivraison($this);
        }

        $this -> id_detailLivraison = $id_detailLivraison;

        return $this;
    }

   
}
