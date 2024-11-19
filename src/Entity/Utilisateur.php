<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur_prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur_nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $utilisateur_siret = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur_mail = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur_reference = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur_mdp = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur_telephone = null;

    #[ORM\Column]
    private ?bool $utilisateur_verifie = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur_coef = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $utilisateur_derniere_co = null;

    /**
     * @var Collection<int, fournisseur>
     */
    #[ORM\ManyToMany(targetEntity: fournisseur::class)]
    private Collection $fournisseur;

    /**
     * @var Collection<int, adresse>
     */
    #[ORM\ManyToMany(targetEntity: adresse::class, inversedBy: 'utilisateurs')]
    private Collection $adresse;

    /**
     * @var Collection<int, role>
     */
    #[ORM\ManyToMany(targetEntity: role::class, inversedBy: 'utilisateurs')]
    private Collection $role;

    #[ORM\ManyToOne(inversedBy: 'utilisateur')]
    private ?Commande $commande = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\ManyToMany(targetEntity: produit::class, inversedBy: 'utilisateurs')]
    private Collection $produit;

    public function __construct()
    {
        $this -> fournisseur = new ArrayCollection();
        $this -> adresse = new ArrayCollection();
        $this -> role = new ArrayCollection();
        $this -> produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getUtilisateurPrenom(): ?string
    {
        return $this -> utilisateur_prenom;
    }

    public function setUtilisateurPrenom(string $utilisateur_prenom): static
    {
        $this -> utilisateur_prenom = $utilisateur_prenom;

        return $this;
    }

    public function getUtilisateurNom(): ?string
    {
        return $this -> utilisateur_nom;
    }

    public function setUtilisateurNom(string $utilisateur_nom): static
    {
        $this -> utilisateur_nom = $utilisateur_nom;

        return $this;
    }

    public function getUtilisateurSiret(): ?string
    {
        return $this -> utilisateur_siret;
    }

    public function setUtilisateurSiret(?string $utilisateur_siret): static
    {
        $this -> utilisateur_siret = $utilisateur_siret;

        return $this;
    }

    public function getUtilisateurMail(): ?string
    {
        return $this -> utilisateur_mail;
    }

    public function setUtilisateurMail(string $utilisateur_mail): static
    {
        $this -> utilisateur_mail = $utilisateur_mail;

        return $this;
    }

    public function getUtilisateurReference(): ?string
    {
        return $this -> utilisateur_reference;
    }

    public function setUtilisateurReference(string $utilisateur_reference): static
    {
        $this -> utilisateur_reference = $utilisateur_reference;

        return $this;
    }

    public function getUtilisateurMdp(): ?string
    {
        return $this -> utilisateur_mdp;
    }

    public function setUtilisateurMdp(string $utilisateur_mdp): static
    {
        $this -> utilisateur_mdp = $utilisateur_mdp;

        return $this;
    }

    public function getUtilisateurTelephone(): ?string
    {
        return $this -> utilisateur_telephone;
    }

    public function setUtilisateurTelephone(string $utilisateur_telephone): static
    {
        $this -> utilisateur_telephone = $utilisateur_telephone;

        return $this;
    }

    public function isUtilisateurVerifie(): ?bool
    {
        return $this -> utilisateur_verifie;
    }

    public function setUtilisateurVerifie(bool $utilisateur_verifie): static
    {
        $this -> utilisateur_verifie = $utilisateur_verifie;

        return $this;
    }

    public function getUtilisateurCoef(): ?string
    {
        return $this -> utilisateur_coef;
    }

    public function setUtilisateurCoef(string $utilisateur_coef): static
    {
        $this -> utilisateur_coef = $utilisateur_coef;

        return $this;
    }

    public function getUtilisateurDerniereCo(): ?\DateTimeInterface
    {
        return $this -> utilisateur_derniere_co;
    }

    public function setUtilisateurDerniereCo(\DateTimeInterface $utilisateur_derniere_co): static
    {
        $this -> utilisateur_derniere_co = $utilisateur_derniere_co;

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
        }

        return $this;
    }

    public function removeFournisseur(fournisseur $fournisseur): static
    {
        $this -> fournisseur -> removeElement($fournisseur);

        return $this;
    }

    /**
     * @return Collection<int, adresse>
     */
    public function getAdresse(): Collection
    {
        return $this -> adresse;
    }

    public function addAdresse(adresse $adresse): static
    {
        if (!$this -> adresse -> contains($adresse)) {
            $this -> adresse -> add($adresse);
        }

        return $this;
    }

    public function removeAdresse(adresse $adresse): static
    {
        $this -> adresse -> removeElement($adresse);

        return $this;
    }

    /**
     * @return Collection<int, role>
     */
    public function getRole(): Collection
    {
        return $this -> role;
    }

    public function addRole(role $role): static
    {
        if (!$this -> role -> contains($role)) {
            $this -> role -> add($role);
        }

        return $this;
    }

    public function removeRole(role $role): static
    {
        $this -> role -> removeElement($role);

        return $this;
    }

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
}
