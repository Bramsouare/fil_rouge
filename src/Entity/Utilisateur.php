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
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['utilisateur_mail'], message: 'There is already an account with this utilisateur_mail')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    // Clé de l'entité.
    #[ORM\Id]
    // Valeur auto-incrementé
    #[ORM\GeneratedValue]
    // Colonne de la table
    #[ORM\Column]
    // Type de la colonne
    private ?int $id = null;

    // Colonne utilisateur_prenom
    #[ORM\Column(length: 255)]
    private ?string $utilisateur_prenom = null;

    // Colonne utilisateur_nom
    #[ORM\Column(length: 255)]
    private ?string $utilisateur_nom = null;

    // Colonne utilisateur_siret
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $utilisateur_siret = null;

    // Colonne utilisateur_mail
    #[ORM\Column(length: 255)]
    private ?string $utilisateur_mail = null;

    // Colonne utilisateur_reference
    #[ORM\Column(length: 255)]
    private ?string $utilisateur_reference = null;

    // Colonne utilisateur_mdp
    #[ORM\Column(length: 255)]
    private ?string $utilisateur_mdp = null;

    // Colonne utilisateur_telephone
    #[ORM\Column(length: 255)]
    private ?string $utilisateur_telephone = null;
    
// TODO boolen ??
    // Colonne utilisateur_coef
    #[ORM\Column(length: 255)]
    private ?string $utilisateur_coef = null;

    // Colonne utilisateur_derniere_co
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $utilisateur_derniere_co = null;

##########################################################################################

   
    public function getUserIdentifier(): string
    {
        return $this->utilisateur_mail; 
    }


    public function getPassword(): string
    {
        return $this->utilisateur_mdp;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // Si vous stockez des données sensibles temporairement dans l'entité (comme un mot de passe en clair),
        // vous pouvez les nettoyer ici.
    }

###########################################################################################

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $role = null;

    /**
     * @var Collection<int, commande>
     */
    // Relation entre utilisateur et commande
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $commande;

    /**
     * @var Collection<int, adresse>
     */
    // Relation entre utilisateur et adresse
    #[ORM\OneToMany(targetEntity: Adresse::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $utilisateur_adresse;

    #[ORM\Column]
    private bool $Verification = false;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'utilisateurs')]
    private Collection $produit;

    /**
     * @var Collection<int, fournisseur>
     */
    #[ORM\OneToMany(targetEntity: Fournisseur::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $fournisseur;

    public function __construct()
    {
        // Initialisation des collections

        $this->commande = new ArrayCollection();
        $this->utilisateur_adresse = new ArrayCollection();
        $this->produit = new ArrayCollection();
        $this->fournisseur = new ArrayCollection();
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################

    public function getId(): ?int
    {
        return $this->id; // Retourne l'id de l'utilisateur
    }

    public function getUtilisateurPrenom(): ?string
    {
        return $this->utilisateur_prenom; // Retourne le prenom de l'utilisateur
    }

    public function setUtilisateurPrenom(string $utilisateur_prenom): static
    {
        $this->utilisateur_prenom = $utilisateur_prenom; // Modifie le prenom de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurNom(): ?string
    {
        return $this->utilisateur_nom; // Retourne le nom de l'utilisateur
    }

    public function setUtilisateurNom(string $utilisateur_nom): static
    {
        $this->utilisateur_nom = $utilisateur_nom; // Modifie le nom de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurSiret(): ?string
    {
        return $this->utilisateur_siret; // Retourne le siret de l'utilisateur
    }

    public function setUtilisateurSiret(?string $utilisateur_siret): static
    {
        $this->utilisateur_siret = $utilisateur_siret; // Modifie le siret de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurMail(): ?string
    {
        return $this->utilisateur_mail; // Retourne le mail de l'utilisateur
    }

    public function setUtilisateurMail(string $utilisateur_mail): static
    {
        $this->utilisateur_mail = $utilisateur_mail; // Modifie le mail de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurReference(): ?string
    {
        return $this->utilisateur_reference; // Retourne la reference de l'utilisateur
    }

    public function setUtilisateurReference(string $utilisateur_reference): static
    {
        $this->utilisateur_reference = $utilisateur_reference; // Modifie la reference de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurMdp(): ?string
    {
        return $this->utilisateur_mdp; // Retourne le mot de passe de l'utilisateur
    }

    public function setUtilisateurMdp(string $utilisateur_mdp): static
    {
        $this->utilisateur_mdp = $utilisateur_mdp; // Modifie le mot de passe de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurTelephone(): ?string
    {
        return $this->utilisateur_telephone; // Retourne le telephone de l'utilisateur
    }

    public function setUtilisateurTelephone(string $utilisateur_telephone): static
    {
        $this->utilisateur_telephone = $utilisateur_telephone; // Modifie le telephone de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurCoef(): ?string
    {
        return $this->utilisateur_coef; // Retourne le coef de l'utilisateur
    }

    public function setUtilisateurCoef(string $utilisateur_coef): static
    {
        $this->utilisateur_coef = $utilisateur_coef; // Modifie le coef de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurDerniereCo(): ?\DateTimeInterface
    {
        return $this->utilisateur_derniere_co; // Retourne la derniere connexion de l'utilisateur
    }

    public function setUtilisateurDerniereCo(\DateTimeInterface $utilisateur_derniere_co): static
    {
        $this->utilisateur_derniere_co = $utilisateur_derniere_co; // Modifie la derniere connexion de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, commande>
     */
    public function getCommande(): Collection
    {
        return $this->commande; // Retourne la collection des commandes
    }

    // Ajoute une commande au utilisateur
    public function addCommande(Commande $commande): static
    {
        // Si la commande n'existe pas dans la collection
        if (!$this->commande->contains($commande)) {

            // Ajoute la commande a la collection
            $this->commande->add($commande);

            // Lie la commande a l'utilisateur
            $commande->setUtilisateur($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime une commande de l'utilisateur
    public function removeCommande(Commande $commande): static
    {
        // Supprime la commande de la collection
        if ($this->commande->removeElement($commande)) {

            // Si la commande est lié au utilisateur
            if ($commande->getUtilisateur() === $this) {

                // Lie la commande a null
                $commande->setUtilisateur(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, adresse>
     */
    public function getUtilisateurAdresse(): Collection
    {
        return $this->utilisateur_adresse; // Retourne la collection des adresses
    }

    // Ajoute une adresse au utilisateur
    public function addUtilisateurAdresse(Adresse $utilisateurAdresse): static
    {
        // Si l'adresse n'existe pas dans la collection
        if (!$this->utilisateur_adresse->contains($utilisateurAdresse)) {

            // Ajoute l'adresse a la collection
            $this->utilisateur_adresse->add($utilisateurAdresse);

            // Lie l'adresse a l'utilisateur
            $utilisateurAdresse->setUtilisateur($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime une adresse de l'utilisateur
    public function removeUtilisateurAdresse(Adresse $utilisateurAdresse): static
    {
        // Supprime l'adresse de la collection
        if ($this->utilisateur_adresse->removeElement($utilisateurAdresse)) {

            // Si l'adresse est liée au utilisateur
            if ($utilisateurAdresse->getUtilisateur() === $this) {

                // Lie l'adresse a null
                $utilisateurAdresse->setUtilisateur(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }

    // Vérifie si l'utilisateur est verifié
    public function isVerified(): bool
    {
        return $this->Verification; // Retourne si l'utilisateur est verifié
    }

    // Modifie si l'utilisateur est verifié
    public function setVerified(bool $Verification): static
    {
        // Si l'utilisateur est verifié 
        $this->Verification = $Verification;

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        $this->produit->removeElement($produit);

        return $this;
    }

    /**
     * @return Collection<int, fournisseur>
     */
    public function getFournisseur(): Collection
    {
        return $this->fournisseur;
    }

    public function addFournisseur(fournisseur $fournisseur): static
    {
        if (!$this->fournisseur->contains($fournisseur)) {
            $this->fournisseur->add($fournisseur);
            $fournisseur->setUtilisateur($this);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): static
    {
        if ($this->fournisseur->removeElement($fournisseur)) {
            // set the owning side to null (unless already changed)
            if ($fournisseur->getUtilisateur() === $this) {
                $fournisseur->setUtilisateur(null);
            }
        }

        return $this;
    }

}
