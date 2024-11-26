<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use App\Entity\DetailLivraison;
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


    #[ORM\ManyToOne(inversedBy: 'livraison')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    /**
     * @var Collection<int, detailLivraison>
     */
    #[ORM\OneToMany(targetEntity: DetailLivraison::class, mappedBy: 'livraison', orphanRemoval: true)]
    private Collection $detailLivraison;

    public function __construct()
    {
        $this->detailLivraison = new ArrayCollection();
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
    public function getCommande(): ?Commande
    {
        return $this -> commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this -> commande = $commande;

        return $this;
    }

    /**
     * @return Collection<int, detailLivraison>
     */
    public function getDetailLivraison(): Collection
    {
        return $this -> detailLivraison;
    }

    public function addDetailLivraison(DetailLivraison $detailLivraison): static
    {
        if (!$this -> detailLivraison -> contains($detailLivraison)) {
            $this -> detailLivraison -> add($detailLivraison);
            $detailLivraison -> setLivraison($this);
        }

        return $this;
    }

    public function removeDetailLivraison(DetailLivraison $detailLivraison): static
    {
        if ($this -> detailLivraison -> removeElement($detailLivraison)) {
            // set the owning side to null (unless already changed)
            if ($detailLivraison -> getLivraison() === $this) {
                $detailLivraison -> setLivraison(null);
            }
        }

        return $this;
    }



   
}
