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

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]

class Utilisateur
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

    // Colonne utilisateur_verifie
    #[ORM\Column]
    private ?bool $utilisateur_verifie = null;

    // Colonne utilisateur_coef
    #[ORM\Column(length: 255)]
    private ?string $utilisateur_coef = null;

    // Colonne utilisateur_derniere_co
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $utilisateur_derniere_co = null;

    /**
     * @var Collection<int, fournisseur>
     */
    // Relation entre utilisateur et fournisseur
    #[ORM\ManyToMany(targetEntity: Fournisseur::class)]
    private Collection $fournisseur;

    // Constructeur
    public function __construct()
    {
        // Initialisation des collections
        $this -> fournisseur = new ArrayCollection();
        $this -> produit = new ArrayCollection();
        $this -> commande = new ArrayCollection();
        $this -> utilisateur_adresse = new ArrayCollection();
        $this -> role = new ArrayCollection();
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################

    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id de l'utilisateur
    }

    public function getUtilisateurPrenom(): ?string
    {
        return $this -> utilisateur_prenom; // Retourne le prenom de l'utilisateur
    }

    public function setUtilisateurPrenom(string $utilisateur_prenom): static
    {
        $this -> utilisateur_prenom = $utilisateur_prenom; // Modifie le prenom de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurNom(): ?string
    {
        return $this -> utilisateur_nom; // Retourne le nom de l'utilisateur
    }

    public function setUtilisateurNom(string $utilisateur_nom): static
    {
        $this -> utilisateur_nom = $utilisateur_nom; // Modifie le nom de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurSiret(): ?string
    {
        return $this -> utilisateur_siret; // Retourne le siret de l'utilisateur
    }

    public function setUtilisateurSiret(?string $utilisateur_siret): static
    {
        $this -> utilisateur_siret = $utilisateur_siret; // Modifie le siret de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurMail(): ?string
    {
        return $this -> utilisateur_mail; // Retourne le mail de l'utilisateur
    }

    public function setUtilisateurMail(string $utilisateur_mail): static
    {
        $this -> utilisateur_mail = $utilisateur_mail; // Modifie le mail de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurReference(): ?string
    {
        return $this -> utilisateur_reference; // Retourne la reference de l'utilisateur
    }

    public function setUtilisateurReference(string $utilisateur_reference): static
    {
        $this -> utilisateur_reference = $utilisateur_reference; // Modifie la reference de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurMdp(): ?string
    {
        return $this -> utilisateur_mdp; // Retourne le mot de passe de l'utilisateur
    }

    public function setUtilisateurMdp(string $utilisateur_mdp): static
    {
        $this -> utilisateur_mdp = $utilisateur_mdp; // Modifie le mot de passe de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurTelephone(): ?string
    {
        return $this -> utilisateur_telephone; // Retourne le telephone de l'utilisateur
    }

    public function setUtilisateurTelephone(string $utilisateur_telephone): static
    {
        $this -> utilisateur_telephone = $utilisateur_telephone; // Modifie le telephone de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function isUtilisateurVerifie(): ?bool
    {
        return $this -> utilisateur_verifie; // Retourne la verification de l'utilisateur
    }

    public function setUtilisateurVerifie(bool $utilisateur_verifie): static
    {
        $this -> utilisateur_verifie = $utilisateur_verifie; // Modifie la verification de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurCoef(): ?string
    {
        return $this -> utilisateur_coef; // Retourne le coef de l'utilisateur
    }

    public function setUtilisateurCoef(string $utilisateur_coef): static
    {
        $this -> utilisateur_coef = $utilisateur_coef; // Modifie le coef de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    public function getUtilisateurDerniereCo(): ?\DateTimeInterface
    {
        return $this -> utilisateur_derniere_co; // Retourne la derniere connexion de l'utilisateur
    }

    public function setUtilisateurDerniereCo(\DateTimeInterface $utilisateur_derniere_co): static
    {
        $this -> utilisateur_derniere_co = $utilisateur_derniere_co; // Modifie la derniere connexion de l'utilisateur

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, fournisseur>
     */
    public function getFournisseur(): Collection
    {
        return $this -> fournisseur; // Retourne les fournisseurs de l'utilisateur
    }

    // Ajoute un fournisseur au utilisateur
    public function addFournisseur(Fournisseur $fournisseur): static
    {
        // Si le fournisseur n'existe pas dans la collection
        if (!$this -> fournisseur -> contains($fournisseur)) {

            // Ajoute le fournisseur a la collection
            $this -> fournisseur -> add($fournisseur);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime un fournisseur au utilisateur
    public function removeFournisseur(Fournisseur $fournisseur): static
    {
        // Supprime le fournisseur de la collection
        $this -> fournisseur -> removeElement($fournisseur);

        return $this; // Retourne l'objet actuel
    }

    /**
     * @var Collection<int, produit>
     */
    // Relation entre utilisateur et produit
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $produit;

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

    /**
     * @var Collection<int, role>
     */
    // Relation entre utilisateur et role
    #[ORM\OneToMany(targetEntity: role::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $role;

    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this -> produit; // Retourne la collection des produits
    }

    // Ajoute un produit au utilisateur
    public function addProduit(Produit $Produit): static
    {
        // Si le produit n'existe pas dans la collection
        if (!$this -> produit -> contains($Produit)) {

            // Ajoute le produit a la collection
            $this -> produit -> add($Produit);

            // Lie le produit a l'utilisateur
            $Produit -> setUtilisateur($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime un produit de l'utilisateur
    public function removeProduit(Produit $Produit): static
    {
        // Supprime le produit de la collection
        if ($this -> produit -> removeElement($Produit)) {
            
            // Si le produit est lié au fournisseur
            if ($Produit -> getUtilisateur() === $this) {
                // Lie le produit a null
                $Produit -> setUtilisateur(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, commande>
     */
    public function getCommande(): Collection
    {
        return $this -> commande; // Retourne la collection des commandes
    }

    // Ajoute une commande au utilisateur
    public function addCommande(Commande $commande): static
    {
        // Si la commande n'existe pas dans la collection
        if (!$this -> commande -> contains($commande)) {

            // Ajoute la commande a la collection
            $this -> commande -> add($commande);

            // Lie la commande a l'utilisateur
            $commande -> setUtilisateur($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime une commande de l'utilisateur
    public function removeCommande(Commande $commande): static
    {
        // Supprime la commande de la collection
        if ($this -> commande -> removeElement($commande)) {
            
            // Si la commande est lié au utilisateur
            if ($commande -> getUtilisateur() === $this) {

                // Lie la commande a null
                $commande -> setUtilisateur(null);
            }
        }

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, adresse>
     */
    public function getUtilisateurAdresse(): Collection
    {
        return $this -> utilisateur_adresse; // Retourne la collection des adresses
    }

    // Ajoute une adresse au utilisateur
    public function addUtilisateurAdresse(Adresse $utilisateurAdresse): static
    {
        // Si l'adresse n'existe pas dans la collection
        if (!$this -> utilisateur_adresse -> contains($utilisateurAdresse)) {

            // Ajoute l'adresse a la collection
            $this -> utilisateur_adresse -> add($utilisateurAdresse);

            // Lie l'adresse a l'utilisateur
            $utilisateurAdresse -> setUtilisateur($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime une adresse de l'utilisateur
    public function removeUtilisateurAdresse(Adresse $utilisateurAdresse): static
    {
        // Supprime l'adresse de la collection
        if ($this -> utilisateur_adresse ->removeElement($utilisateurAdresse)) {
            
            // Si l'adresse est liée au utilisateur
            if ($utilisateurAdresse -> getUtilisateur() === $this) {

                // Lie l'adresse a null
                $utilisateurAdresse -> setUtilisateur(null);
            } 
        }

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, role>
     */
    public function getRole(): Collection
    {
        return $this -> role; // Retourne la collection des roles
    }

    // Ajoute un role au utilisateur
    public function addRole(role $role): static
    {
        // Si le role n'existe pas dans la collection
        if (!$this -> role -> contains($role)) {

            // Ajoute le role a la collection
            $this -> role -> add($role);

            // Lie le role a l'utilisateur
            $role -> setUtilisateur($this);
        }

        return $this; // Retourne l'objet actuel
    }

    // Supprime un role de l'utilisateur
    public function removeRole(role $role): static
    {
        // Supprime le role de la collection
        if ($this -> role -> removeElement($role)) {
            
            // Si le role est lié au utilisateur
            if ($role -> getUtilisateur() === $this) {

                // Lie le role a null
                $role -> setUtilisateur(null);
            }
        }

        return $this;// Retourne l'objet actuel
    }
    
}
