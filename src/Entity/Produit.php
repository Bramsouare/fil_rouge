<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $produit_libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $produit_description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?float $produit_prix_ht = null;

    #[ORM\Column(length: 255)]
    private ?string $produit_reference = null;

    #[ORM\Column(length: 255)]
    private ?string $produit_image = null;

    #[ORM\Column]
    private ?bool $produit_actif = null;

    #[ORM\Column(length: 255)]
    private ?string $produit_stock = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?tva $tva = null;

    /**
     * @var Collection<int, rubrique>
     */
    #[ORM\OneToMany(targetEntity: rubrique::class, mappedBy: 'produit')]
    private Collection $rubrique;

    /**
     * @var Collection<int, fournisseur>
     */
    #[ORM\OneToMany(targetEntity: fournisseur::class, mappedBy: 'produit')]
    private Collection $fournisseur;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'produit')]
    private Collection $commandes;

    /**
     * @var Collection<int, Livraison>
     */
    #[ORM\ManyToMany(targetEntity: Livraison::class, mappedBy: 'produit')]
    private Collection $livraisons;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'produit')]
    private Collection $utilisateurs;

    /**
     * @var Collection<int, Appartient>
     */
    #[ORM\ManyToMany(targetEntity: Appartient::class, mappedBy: 'commande')]
    private Collection $appartients;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Appartient $appartient = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genere $genere = null;

    public function __construct()
    {
        $this -> rubrique = new ArrayCollection();
        $this -> fournisseur = new ArrayCollection();
        $this -> commandes = new ArrayCollection();
        $this -> livraisons = new ArrayCollection();
        $this -> utilisateurs = new ArrayCollection();
        $this -> appartients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getProduitLibelle(): ?string
    {
        return $this -> produit_libelle;
    }

    public function setProduitLibelle(string $produit_libelle): static
    {
        $this -> produit_libelle = $produit_libelle;

        return $this;
    }

    public function getProduitDescription(): ?string
    {
        return $this -> produit_description;
    }

    public function setProduitDescription(string $produit_description): static
    {
        $this -> produit_description = $produit_description;

        return $this;
    }

    public function getProduitPrixHt(): ?string
    {
        return $this -> produit_prix_ht;
    }

    public function setProduitPrixHt(string $produit_prix_ht): static
    {
        $this -> produit_prix_ht = $produit_prix_ht;

        return $this;
    }

    public function getProduitReference(): ?string
    {
        return $this -> produit_reference;
    }

    public function setProduitReference(string $produit_reference): static
    {
        $this -> produit_reference = $produit_reference;

        return $this;
    }

    public function getProduitImage(): ?string
    {
        return $this -> produit_image;
    }

    public function setProduitImage(string $produit_image): static
    {
        $this -> produit_image = $produit_image;

        return $this;
    }

    public function isProduitActif(): ?bool
    {
        return $this -> produit_actif;
    }

    public function setProduitActif(bool $produit_actif): static
    {
        $this -> produit_actif = $produit_actif;

        return $this;
    }

    public function getProduitStock(): ?string
    {
        return $this -> produit_stock;
    }

    public function setProduitStock(string $produit_stock): static
    {
        $this -> produit_stock = $produit_stock;

        return $this;
    }

    public function getTva(): ?tva
    {
        return $this -> tva;
    }

    public function setTva(?tva $tva): static
    {
        $this -> tva = $tva;

        return $this;
    }

    /**
     * @return Collection<int, rubrique>
     */
    public function getRubrique(): Collection
    {
        return $this -> rubrique;
    }

    public function addRubrique(rubrique $rubrique): static
    {
        if (!$this -> rubrique -> contains($rubrique)) {
            $this -> rubrique -> add($rubrique);
            $rubrique -> setProduit($this);
        }

        return $this;
    }

    public function removeRubrique(rubrique $rubrique): static
    {
        if ($this -> rubrique -> removeElement($rubrique)) {
            // set the owning side to null (unless already changed)
            if ($rubrique -> getProduit() === $this) {
                $rubrique -> setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, fournisseur>
     */
    public function getFournisseur(): Collection
    {
        return $this -> fournisseur;
    }

    public function addFournisseur(fournisseur $fournisseur): static
    {
        if (!$this -> fournisseur -> contains($fournisseur)) {
            $this -> fournisseur -> add($fournisseur);
            $fournisseur -> setProduit($this);
        }

        return $this;
    }

    public function removeFournisseur(fournisseur $fournisseur): static
    {
        if ($this -> fournisseur -> removeElement($fournisseur)) {
            // set the owning side to null (unless already changed)
            if ($fournisseur -> getProduit() === $this) {
                $fournisseur -> setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this -> commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this -> commandes -> contains($commande)) {
            $this -> commandes -> add($commande);
            $commande -> addProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this -> commandes -> removeElement($commande)) {
            $commande -> removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this -> livraisons;
    }

    public function addLivraison(Livraison $livraison): static
    {
        if (!$this -> livraisons -> contains($livraison)) {
            $this -> livraisons -> add($livraison);
            $livraison -> addProduit($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): static
    {
        if ($this -> livraisons -> removeElement($livraison)) {
            $livraison -> removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this -> utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this -> utilisateurs -> contains($utilisateur)) {
            $this -> utilisateurs -> add($utilisateur);
            $utilisateur -> addProduit($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this -> utilisateurs -> removeElement($utilisateur)) {
            $utilisateur -> removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Appartient>
     */
    public function getAppartients(): Collection
    {
        return $this -> appartients;
    }

    public function addAppartient(Appartient $appartient): static
    {
        if (!$this -> appartients -> contains($appartient)) {
            $this -> appartients -> add($appartient);
            $appartient -> setProduit($this);
        }

        return $this;
    }

    public function removeAppartient(Appartient $appartient): static
    {
        if ($this -> appartients -> removeElement($appartient)) {
            $appartient -> setProduit($this);
        }

        return $this;
    }

    public function getAppartient(): ?Appartient
    {
        return $this -> appartient;
    }

    public function setAppartient(?Appartient $appartient): static
    {
        $this -> appartient = $appartient;

        return $this;
    }

    public function getGenere(): ?Genere
    {
        return $this->genere;
    }

    public function setGenere(?Genere $genere): static
    {
        $this->genere = $genere;

        return $this;
    }
}
