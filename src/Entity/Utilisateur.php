<?php

namespace App\Entity;

use App\Entity\Role;
use App\Entity\Adresse;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\Fournisseur;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


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
    #[ORM\ManyToMany(targetEntity: Fournisseur::class)]
    private Collection $fournisseur;

    public function __construct()
    {
        $this -> fournisseur = new ArrayCollection();
        $this -> produit = new ArrayCollection();
        $this -> commande = new ArrayCollection();
        $this->utilisateur_adresse = new ArrayCollection();
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

    public function addFournisseur(Fournisseur $fournisseur): static
    {
        if (!$this -> fournisseur -> contains($fournisseur)) {
            $this -> fournisseur -> add($fournisseur);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): static
    {
        $this -> fournisseur -> removeElement($fournisseur);

        return $this;
    }

  

    #[ORM\OneToOne(inversedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $role = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $produit;

    /**
     * @var Collection<int, commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $commande;

    /**
     * @var Collection<int, adresse>
     */
    #[ORM\OneToMany(targetEntity: Adresse::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $utilisateur_adresse;




    public function getRole(): ?Role
    {
        return $this -> role;
    }

    public function setRole(Role $role): static
    {
        $this -> role = $role;

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
            $Produit -> setUtilisateur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $Produit): static
    {
        if ($this -> produit -> removeElement($Produit)) {
            // set the owning side to null (unless already changed)
            if ($Produit -> getUtilisateur() === $this) {
                $Produit -> setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, commande>
     */
    public function getCommande(): Collection
    {
        return $this -> commande;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this -> commande -> contains($commande)) {
            $this -> commande -> add($commande);
            $commande -> setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this -> commande -> removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande -> getUtilisateur() === $this) {
                $commande -> setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, adresse>
     */
    public function getUtilisateurAdresse(): Collection
    {
        return $this->utilisateur_adresse;
    }

    public function addUtilisateurAdresse(Adresse $utilisateurAdresse): static
    {
        if (!$this->utilisateur_adresse->contains($utilisateurAdresse)) {
            $this->utilisateur_adresse->add($utilisateurAdresse);
            $utilisateurAdresse->setUtilisateur($this);
        }

        return $this;
    }

    public function removeUtilisateurAdresse(Adresse $utilisateurAdresse): static
    {
        if ($this->utilisateur_adresse->removeElement($utilisateurAdresse)) {
            // set the owning side to null (unless already changed)
            if ($utilisateurAdresse->getUtilisateur() === $this) {
                $utilisateurAdresse->setUtilisateur(null);
            }
        }

        return $this;
    }


    
}
