<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Adresse;
use App\Entity\Role;


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

    public function __construct()
    {
        $this -> fournisseur = new ArrayCollection();
        $this -> id_adresse = new ArrayCollection();
        $this -> id_produit = new ArrayCollection();
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

    private ?Adresse $utilisateur_adresse = null;

    /**
     * @var Collection<int, Adresse>
     */
    #[ORM\OneToMany(targetEntity: Adresse::class, mappedBy: 'id_client', orphanRemoval: true)]
    private Collection $id_adresse;

    #[ORM\OneToOne(mappedBy: 'id_utilisateur', cascade: ['persist', 'remove'])]
    private ?Fournisseur $id_fournisseur = null;

    #[ORM\OneToOne(inversedBy: 'id_utilisateur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?role $id_role = null;

    #[ORM\OneToOne(inversedBy: 'id_utilisateur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?commande $id_commande = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'id_utilisateur', orphanRemoval: true)]
    private Collection $id_produit;

    public function getUtilisateurAdresse(): ?Adresse
    {
        return $this -> utilisateur_adresse;
    }

    public function setUtilisateurAdresse(?Adresse $utilisateur_adresse): self
    {
        $this -> utilisateur_adresse = $utilisateur_adresse;

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getIdAdresse(): Collection
    {
        return $this -> id_adresse;
    }

    public function addIdAdresse(Adresse $idAdresse): static
    {
        if (!$this -> id_adresse -> contains($idAdresse)) {
            $this -> id_adresse -> add($idAdresse);
            $idAdresse -> setIdClient($this);
        }

        return $this;
    }

    public function removeIdAdresse(Adresse $idAdresse): static
    {
        if ($this -> id_adresse -> removeElement($idAdresse)) {
            // set the owning side to null (unless already changed)
            if ($idAdresse -> getIdClient() === $this) {
                $idAdresse -> setIdClient(null);
            }
        }

        return $this;
    }

    public function getIdFournisseur(): ?Fournisseur
    {
        return $this -> id_fournisseur;
    }

    public function setIdFournisseur(Fournisseur $id_fournisseur): static
    {
        // set the owning side of the relation if necessary
        if ($id_fournisseur -> getIdUtilisateur() !== $this) {
            $id_fournisseur -> setIdUtilisateur($this);
        }

        $this -> id_fournisseur = $id_fournisseur;

        return $this;
    }

    public function getIdRole(): ?role
    {
        return $this -> id_role;
    }

    public function setIdRole(role $id_role): static
    {
        $this -> id_role = $id_role;

        return $this;
    }

    public function getIdCommande(): ?commande
    {
        return $this -> id_commande;
    }

    public function setIdCommande(commande $id_commande): static
    {
        $this -> id_commande = $id_commande;

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
            $idProduit -> setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeIdProduit(produit $idProduit): static
    {
        if ($this -> id_produit -> removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit -> getIdUtilisateur() === $this) {
                $idProduit -> setIdUtilisateur(null);
            }
        }

        return $this;
    }

    
}
