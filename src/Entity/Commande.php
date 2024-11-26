<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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
     * @var Collection<int, utilisateur>
     */
    #[ORM\OneToMany(targetEntity: utilisateur::class, mappedBy: 'commande')]
    private Collection $utilisateur;


    #[ORM\OneToOne(mappedBy: 'id_commande', cascade: ['persist', 'remove'])]
    private ?Utilisateur $id_utilisateur = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'id_commande', orphanRemoval: true)]
    private Collection $id_produit;


    /**
     * @var Collection<int, livraison>
     */
    #[ORM\OneToMany(targetEntity: livraison::class, mappedBy: 'id_commande', orphanRemoval: true)]
    private Collection $livraison;

    #[ORM\OneToOne(mappedBy: 'id_commande', cascade: ['persist', 'remove'])]
    private ?Facture $id_facture = null;

    #[ORM\OneToOne(mappedBy: 'id_commande', cascade: ['persist', 'remove'])]
    private ?DetailCommande $id_detailCommande = null;

  
    public function __construct()
    {
        $this -> utilisateur = new ArrayCollection();
        $this -> id_produit = new ArrayCollection();
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
     * @return Collection<int, utilisateur>
     */
    public function getUtilisateur(): Collection
    {
        return $this -> utilisateur;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this -> id_utilisateur;
    }

    public function setIdUtilisateur(Utilisateur $id_utilisateur): static
    {
        // set the owning side of the relation if necessary
        if ($id_utilisateur -> getIdCommande() !== $this) {
            $id_utilisateur -> setIdCommande($this);
        }

        $this -> id_utilisateur = $id_utilisateur;

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
            $idProduit -> setIdCommande($this);
        }

        return $this;
    }

    public function removeIdProduit(produit $idProduit): static
    {
        if ($this -> id_produit -> removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit -> getIdCommande() === $this) {
                $idProduit -> setIdCommande(null);
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

    public function addLivraison(livraison $livraison): static
    {
        if (!$this -> livraison -> contains($livraison)) {
            $this -> livraison -> add($livraison);
            $livraison -> setIdCommande($this);
        }

        return $this;
    }

    public function removeLivraison(livraison $livraison): static
    {
        if ($this -> livraison -> removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison -> getIdCommande() === $this) {
                $livraison -> setIdCommande(null);
            }
        }

        return $this;
    }

    public function getIdFacture(): ?Facture
    {
        return $this -> id_facture;
    }

    public function setIdFacture(Facture $id_facture): static
    {
        // set the owning side of the relation if necessary
        if ($id_facture -> getIdCommande() !== $this) {
            $id_facture -> setIdCommande($this);
        }

        $this -> id_facture = $id_facture;

        return $this;
    }

    public function getIdDetailCommande(): ?DetailCommande
    {
        return $this -> id_detailCommande;
    }

    public function setIdDetailCommande(DetailCommande $id_detailCommande): static
    {
        // set the owning side of the relation if necessary
        if ($id_detailCommande -> getIdCommande() !== $this) {
            $id_detailCommande -> setIdCommande($this);
        }

        $this -> id_detailCommande = $id_detailCommande;

        return $this;
    }

}
