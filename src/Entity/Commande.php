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
    // Clefs primaires de l'entité
    #[ORM\Id]
    // Valeur auto-incrementé par la base de données
    #[ORM\GeneratedValue]
    // Colonne de la base de données
    #[ORM\Column]
    // Type de la colonne
    private ?int $id = null;

    // Colonne commande_paiement
    #[ORM\Column(length: 255)]
    private ?string $commande_paiement = null;

    // Colonne commande_date
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commande_date = null;

    // Colonne commande_date_paiement
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commande_date_paiement = null;

    // Colonne commande_differe
    #[ORM\Column]
    private ?bool $commande_differe = null;

    // Colonne commande_statut
    #[ORM\Column(length: 255)]
    private ?string $commande_statut = null;

    // Colonne commande_reference
    #[ORM\Column(length: 255)]
    private ?string $commande_reference = null;

    // Colonne commande_facture_date
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commande_facture_date = null;

    // Colonne commande_total_ht
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 10)]
    private ?string $commande_total_ht = null;

    ###############
    #  Relations  #
    ###############

    /**
     * @var Collection<int, livraison>
     */
    #[ORM\OneToMany(targetEntity: Livraison::class, mappedBy: 'commande', orphanRemoval: true)]
    private Collection $livraison;

    // Relations entre commande et facture
    #[ORM\OneToOne(mappedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?Facture $facture = null;

    // Relations entre commande et utilisateur
    #[ORM\ManyToOne(inversedBy: 'commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    /**
     * @var Collection<int, DetailCommande>
     */
    #[ORM\OneToMany(targetEntity: DetailCommande::class, mappedBy: 'commande', orphanRemoval: true)]
    private Collection $detailCommandes;

    // Constructeur de l'entité
    public function __construct()
    {
        
        $this -> livraison = new ArrayCollection();
        $this->detailCommandes = new ArrayCollection();
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################

    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id de la commande.
    }

    public function getCommandePaiement(): ?string
    {
        return $this -> commande_paiement; // Retourne le moyen de paiement de la commande.
    }

    public function setCommandePaiement(string $commande_paiement): static
    {
        $this -> commande_paiement = $commande_paiement; // Modifie le moyen de paiement de la commande.

        return $this; // Retourne l'objet actuel.
    }

    public function getCommandeDate(): ?\DateTimeInterface
    {
        return $this -> commande_date; // Retourne la date de la commande.
    }

    public function setCommandeDate(\DateTimeInterface $commande_date): static
    {
        $this -> commande_date = $commande_date; // Modifie la date de la commande.

        return $this; // Retourne l'objet actuel.
    }

    public function getCommandeDatePaiement(): ?\DateTimeInterface
    {
        return $this -> commande_date_paiement; // Retourne la date de paiement de la commande.
    }

    public function setCommandeDatePaiement(\DateTimeInterface $commande_date_paiement): static
    {
        $this -> commande_date_paiement = $commande_date_paiement; // Modifie la date de paiement de la commande.

        return $this; // Retourne l'objet actuel.
    }

    public function isCommandeDiffere(): ?bool
    {
        return $this -> commande_differe; // Retourne si la commande est différente.
    }

    public function setCommandeDiffere(bool $commande_differe): static
    {
        $this -> commande_differe = $commande_differe; // Modifie si la commande est différente.

        return $this; // Retourne l'objet actuel.
    }

    public function getCommandeStatut(): ?string
    {
        return $this -> commande_statut; // Retourne le statut de la commande.
    }

    public function setCommandeStatut(string $commande_statut): static
    {
        $this -> commande_statut = $commande_statut; // Modifie le statut de la commande.

        return $this; // Retourne l'objet actuel.
    }

    public function getCommandeReference(): ?string
    {
        return $this -> commande_reference; // Retourne la reference de la commande.
    }

    public function setCommandeReference(string $commande_reference): static
    {
        $this -> commande_reference = $commande_reference; // Modifie la reference de la commande.

        return $this; // Retourne l'objet actuel.
    }

    public function getCommandeFactureDate(): ?\DateTimeInterface
    {
        return $this -> commande_facture_date; // Retourne la date de la facture de la commande.
    }

    public function setCommandeFactureDate(\DateTimeInterface $commande_facture_date): static
    {
        $this -> commande_facture_date = $commande_facture_date; // Modifie la date de la facture de la commande.

        return $this; // Retourne l'objet actuel.
    }

    public function getCommandeTotalHt(): ?string
    {
        return $this -> commande_total_ht; // Retourne le total hors taxes de la commande.
    }

    public function setCommandeTotalHt(string $commande_total_ht): static
    {
        $this -> commande_total_ht = $commande_total_ht; // Modifie le total hors taxes de la commande.

        return $this; // Retourne l'objet actuel.
    }

    /**
     * @return Collection<int, livraison>
     */
    public function getLivraison(): Collection
    {
        return $this -> livraison; // Retourne la collection des livraisons de la commande.
    }

    // Ajoute une livraison a la commande
    public function addLivraison(Livraison $livraison): static
    {
        // Si la livraison n'existe pas dans la collection
        if (!$this -> livraison -> contains($livraison)) {

            // Ajoute la livraison a la collection
            $this -> livraison -> add($livraison);

            // Lie la livraison a la commande
            $livraison -> setCommande($this);
        }

        return $this; // Retourne l'objet actuel.
    }

    // Supprime une livraison de la commande
    public function removeLivraison(Livraison $livraison): static
    {
        // Si la livraison existe dans la collection
        if ($this -> livraison -> removeElement($livraison)) {
            
            // Si la livraison est lie a la commande
            if ($livraison -> getCommande() === $this) {

                // Lie la livraison a null
                $livraison -> setCommande(null);
            }
        }

        return $this; // Retourne l'objet actuel.
    }

    public function getFacture(): ?Facture
    {
        return $this -> facture; // Retourne la facture de la commande.
    }

    // Lie la facture a la commande
    public function setFacture(Facture $facture): static
    {
        // Si la facture n'est pas liee a la commande
        if ($facture -> getCommande() !== $this) {

            // Lie la facture a la commande
            $facture -> setCommande($this);
        }

        // Lie la commande a la facture
        $this -> facture = $facture; 

        return $this; // Retourne l'objet actuel.
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this -> utilisateur; // Retourne l'utilisateur de la commande.
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this -> utilisateur = $utilisateur; // Modifie l'utilisateur de la commande.

        return $this; // Retourne l'objet actuel.
    }

    /**
     * @return Collection<int, DetailCommande>
     */
    public function getDetailCommandes(): Collection
    {
        return $this->detailCommandes;
    }

    public function addDetailCommande(DetailCommande $detailCommande): static
    {
        if (!$this->detailCommandes->contains($detailCommande)) {
            $this->detailCommandes->add($detailCommande);
            $detailCommande->setCommande($this);
        }

        return $this;
    }

    public function removeDetailCommande(DetailCommande $detailCommande): static
    {
        if ($this->detailCommandes->removeElement($detailCommande)) {
            // set the owning side to null (unless already changed)
            if ($detailCommande->getCommande() === $this) {
                $detailCommande->setCommande(null);
            }
        }

        return $this;
    }

}
