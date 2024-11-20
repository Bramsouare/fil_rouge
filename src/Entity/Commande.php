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

    /**
     * @var Collection<int, produit>
     */
    #[ORM\ManyToMany(targetEntity: produit::class, inversedBy: 'commandes')]
    private Collection $produit;

    #[ORM\ManyToOne(inversedBy: 'commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livraison $livraison = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?facture $facture = null;

  
    public function __construct()
    {
        $this -> utilisateur = new ArrayCollection();
        $this -> produit = new ArrayCollection();
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

    public function addUtilisateur(utilisateur $utilisateur): static
    {
        if (!$this -> utilisateur -> contains($utilisateur)) {
            $this -> utilisateur -> add($utilisateur);
            $utilisateur -> setCommande($this);
        }

        return $this;
    }

    public function removeUtilisateur(utilisateur $utilisateur): static
    {
        if ($this -> utilisateur -> removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur -> getCommande() === $this) {
                $utilisateur -> setCommande(null);
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

    public function getLivraison(): ?Livraison
    {
        return $this -> livraison;
    }

    public function setLivraison(?Livraison $livraison): static
    {
        $this -> livraison = $livraison;

        return $this;
    }

    public function getFacture(): ?facture
    {
        return $this -> facture;
    }

    public function setFacture(?facture $facture): static
    {
        $this -> facture = $facture;

        return $this;
    }

}
