<?php

namespace App\Entity;

// Importation des classes nécessaires.
use App\Entity\Fournisseur;
use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: AdresseRepository::class)] 

class Adresse
{
    //Clé primaire de l'entité.
    #[ORM\Id]
    // la valeur de cette clé sera auto-incrémentée dans la base de données.
    #[ORM\GeneratedValue] 
    //Colonne dans la table de la base de données.
    #[ORM\Column] 
    // l'id unique de chaque adresse. Valeur initiale : null.
    private ?int $id = null; 

    // Une colonne texte pour stocker le libellé de l'adresse.
    #[ORM\Column(length: 255)] 
    private ?string $adresse_libelle = null; 

    // Une colonne texte pour stocker la ville de l'adresse.
    #[ORM\Column(length: 255)] 
    private ?string $adresse_ville = null; 

    // Une colonne texte pour stocker le code postal de l'adresse.
    #[ORM\Column(length: 255)] 
    private ?string $adresse_postal = null; 

    // Une colonne texte pour stocker le type d'adresse.
    #[ORM\Column(length: 255)] 
    private ?string $adresse_type = null; 

    // Une colonne texte pour stocker le téléphone lié à l'adresse.
    #[ORM\Column(length: 255)] 
    private ?string $adresse_telephone = null; 

    // Une relation avec l'entité Fournisseur.
    #[ORM\ManyToOne(inversedBy: 'adresse')] 
    #[ORM\JoinColumn(nullable: true)] 
    private ?Fournisseur $fournisseur = null; 

    // Une relation avec l'entité Utilisateur.
    #[ORM\ManyToOne(inversedBy: 'utilisateur_adresse')] 
    #[ORM\JoinColumn(nullable: false)] 
    private ?Utilisateur $utilisateur = null; 

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################

    public function getId(): ?int
    {
        return $this -> id; // Retourne l'identifiant de l'adresse.
    }

    public function getAdresseLibelle(): ?string
    {
        return $this -> adresse_libelle; // Retourne le libellé de l'adresse.
    }

    public function setAdresseLibelle(string $adresse_libelle): static
    {
        $this -> adresse_libelle = $adresse_libelle; // Modifie le libellé de l'adresse.
        return $this; // Retourne l'objet actuel.
    }

    public function getAdresseVille(): ?string
    {
        return $this -> adresse_ville; // Retourne la ville de l'adresse.
    }

    public function setAdresseVille(string $adresse_ville): static
    {
        $this -> adresse_ville = $adresse_ville; // Modifie la ville de l'adresse.
        return $this; // Retourne l'objet actuel.
    }

    public function getAdressePostal(): ?string
    {
        return $this -> adresse_postal; // Retourne le code postal.
    }

    public function setAdressePostal(int $adresse_postal): static
    {
        $this -> adresse_postal = $adresse_postal; // Modifie le code postal.
        return $this; // Retourne l'objet actuel.
    }

    public function getAdresseType(): ?string
    {
        return $this -> adresse_type; // Retourne le type d'adresse.
    }

    public function setAdresseType(string $adresse_type): static
    {
        $this -> adresse_type = $adresse_type; // Modifie le type d'adresse.
        return $this; // Retourne l'objet actuel.
    }

    public function getAdresseTelephone(): ?string
    {
        return $this -> adresse_telephone; // Retourne le téléphone lié à l'adresse.
    }

    public function setAdresseTelephone(string $adresse_telephone): static
    {
        $this -> adresse_telephone = $adresse_telephone; // Modifie le téléphone lié à l'adresse.
        return $this; // Retourne l'objet actuel.
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this -> fournisseur; // Retourne le fournisseur lié à l'adresse.
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this -> fournisseur = $fournisseur; // Modifie le fournisseur lié à l'adresse.
        return $this; // Retourne l'objet actuel.
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this -> utilisateur; // Retourne l'utilisateur lié à l'adresse.
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this -> utilisateur = $utilisateur; // Modifie l'utilisateur lié à l'adresse.
        return $this; // Retourne l'objet actuel.
    }
}
