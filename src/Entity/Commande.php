<?php

namespace App\Entity;

use App\Entity\Facture;
use App\Entity\Produit;
use App\Entity\Livraison;
use App\Entity\DetailCommande;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]

class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $commande_paiement = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commande_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commande_date_paiement = null;

    #[ORM\Column]
    private ?bool $commande_differe = null;

    #[ORM\Column(length: 255)]
    private ?string $commande_statut = null;

    #[ORM\Column(length: 255)]
    private ?string $commande_reference = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commande_facture_date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 10)]
    private ?string $commande_total_ht = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'commande', orphanRemoval: true)]
    private Collection $produit;

    /**
     * @var Collection<int, livraison>
     */
    #[ORM\OneToMany(targetEntity: Livraison::class, mappedBy: 'commande', orphanRemoval: true)]
    private Collection $livraison;

    #[ORM\OneToOne(mappedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?Facture $facture = null;

    #[ORM\OneToOne(mappedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?DetailCommande $detailCommande = null;

    #[ORM\ManyToOne(inversedBy: 'commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

  
    public function __construct()
    {
        $this -> produit = new ArrayCollection();
        $this -> livraison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getCommandePaiement(): ?string
    {
        return $this -> commande_paiement;
    }

    public function setCommandePaiement(string $commande_paiement): static
    {
        $this -> commande_paiement = $commande_paiement;

        return $this;
    }

    public function getCommandeDate(): ?\DateTimeInterface
    {
        return $this -> commande_date;
    }

    public function setCommandeDate(\DateTimeInterface $commande_date): static
    {
        $this -> commande_date = $commande_date;

        return $this;
    }

    public function getCommandeDatePaiement(): ?\DateTimeInterface
    {
        return $this -> commande_date_paiement;
    }

    public function setCommandeDatePaiement(\DateTimeInterface $commande_date_paiement): static
    {
        $this -> commande_date_paiement = $commande_date_paiement;

        return $this;
    }

    public function isCommandeDiffere(): ?bool
    {
        return $this -> commande_differe;
    }

    public function setCommandeDiffere(bool $commande_differe): static
    {
        $this -> commande_differe = $commande_differe;

        return $this;
    }

    public function getCommandeStatut(): ?string
    {
        return $this -> commande_statut;
    }

    public function setCommandeStatut(string $commande_statut): static
    {
        $this -> commande_statut = $commande_statut;

        return $this;
    }

    public function getCommandeReference(): ?string
    {
        return $this -> commande_reference;
    }

    public function setCommandeReference(string $commande_reference): static
    {
        $this -> commande_reference = $commande_reference;

        return $this;
    }

    public function getCommandeFactureDate(): ?\DateTimeInterface
    {
        return $this -> commande_facture_date;
    }

    public function setCommandeFactureDate(\DateTimeInterface $commande_facture_date): static
    {
        $this -> commande_facture_date = $commande_facture_date;

        return $this;
    }

    public function getCommandeTotalHt(): ?string
    {
        return $this -> commande_total_ht;
    }

    public function setCommandeTotalHt(string $commande_total_ht): static
    {
        $this -> commande_total_ht = $commande_total_ht;

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
            $Produit -> setCommande($this);
        }

        return $this;
    }

    public function removeProduit(Produit $Produit): static
    {
        if ($this -> produit -> removeElement($Produit)) {
            // set the owning side to null (unless already changed)
            if ($Produit -> getCommande() === $this) {
                $Produit -> setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, livraison>
     */
    public function getLivraison(): Collection
    {
        return $this -> livraison;
    }

    public function addLivraison(Livraison $livraison): static
    {
        if (!$this -> livraison -> contains($livraison)) {
            $this -> livraison -> add($livraison);
            $livraison -> setCommande($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): static
    {
        if ($this -> livraison -> removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison -> getCommande() === $this) {
                $livraison -> setCommande(null);
            }
        }

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this -> facture;
    }

    public function setFacture(Facture $facture): static
    {
        // set the owning side of the relation if necessary
        if ($facture -> getCommande() !== $this) {
            $facture -> setCommande($this);
        }

        $this -> facture = $facture;

        return $this;
    }

    public function getDetailCommande(): ?DetailCommande
    {
        return $this -> detailCommande;
    }

    public function setDetailCommande(DetailCommande $detailCommande): static
    {
        // set the owning side of the relation if necessary
        if ($detailCommande -> getCommande() !== $this) {
            $detailCommande -> setCommande($this);
        }

        $this -> detailCommande = $detailCommande;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this -> utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this -> utilisateur = $utilisateur;

        return $this;
    }


}
