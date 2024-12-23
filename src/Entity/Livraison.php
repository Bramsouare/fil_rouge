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
    // Clés primaire de l'entité
    #[ORM\Id]
    // Valeurs auto-générées
    #[ORM\GeneratedValue]
    // Colonne de la table
    #[ORM\Column]
    // L'id de la livraison
    private ?int $id = null;

    // Statut de la livraison
    #[ORM\Column(length: 255)]
    private ?string $livraison_statut = null;

    // Date de la livraison
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $livraison_date = null;

    // Reference de la livraison
    #[ORM\Column(length: 255)]
    private ?string $livraison_reference = null;

    // Relation entre la commande et la livraison
    #[ORM\ManyToOne(inversedBy: 'livraison')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    /**
     * @var Collection<int, DetailLivraison>
     */
    #[ORM\OneToMany(targetEntity: DetailLivraison::class, mappedBy: 'livraison', orphanRemoval: true)]
    private Collection $detailLivraisons;

    public function __construct()
    {
        $this->detailLivraisons = new ArrayCollection();
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################
    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id de la livraison
    }

    public function getLivraisonStatut(): ?string
    {
        return $this -> livraison_statut; // Retourne le statut de la livraison
    }

    public function setLivraisonStatut(string $livraison_statut): static
    {
        $this -> livraison_statut = $livraison_statut; // Modifie le statut de la livraison

        return $this; // Retourne l'objet actuel
    }

    public function getLivraisonDate(): ?\DateTimeInterface
    {
        return $this -> livraison_date; // Retourne la date de la livraison
    }

    public function setLivraisonDate(\DateTimeInterface $livraison_date): static
    {
        $this -> livraison_date = $livraison_date; // Modifie la date de la livraison

        return $this; // Retourne l'objet actuel
    }

    public function getLivraisonReference(): ?string
    {
        return $this -> livraison_reference; // Retourne la reference de la livraison
    }

    public function setLivraisonReference(string $livraison_reference): static
    {
        $this -> livraison_reference = $livraison_reference; // Modifie la reference de la livraison

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, DetailLivraison>
     */

    public function getCommande(): ?Commande
    {
        return $this -> commande; // Retourne la commande
    }

    public function setCommande(?Commande $commande): static
    {
        $this -> commande = $commande; // Modifie la commande

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, DetailLivraison>
     */
    public function getDetailLivraisons(): Collection
    {
        return $this->detailLivraisons;
    }

    public function addDetailLivraison(DetailLivraison $detailLivraison): static
    {
        if (!$this->detailLivraisons->contains($detailLivraison)) {
            $this->detailLivraisons->add($detailLivraison);
            $detailLivraison->setLivraison($this);
        }

        return $this;
    }

    public function removeDetailLivraison(DetailLivraison $detailLivraison): static
    {
        if ($this->detailLivraisons->removeElement($detailLivraison)) {
            // set the owning side to null (unless already changed)
            if ($detailLivraison->getLivraison() === $this) {
                $detailLivraison->setLivraison(null);
            }
        }

        return $this;
    }
   
}
