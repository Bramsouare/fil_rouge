<?php

namespace App\Entity;
// Gestion des opérations de recherche de bd de la classe récupérer, manipuler et gérer les objets Inscription.
use App\Repository\InscriptionRepository;
// Liaison des attributs avec la table de la bd.
use Doctrine\ORM\Mapping as ORM;
// Contraintes de validation lors de la validation des données. 
use Symfony\Component\Validator\Constraints as Assert;

// Marque la classe comme une entité de Doctrine, qui correspondra à une table de la bd.
#[ORM\Entity(repositoryClass: InscriptionRepository::class)]

class Inscription
{
    // $id est la clé primaire de la table de la bd.
    #[ORM\Id]
    // $id est auto-incrementée par la bd
    #[ORM\GeneratedValue]
    // $id est une colonne de la bd
    #[ORM\Column]
    // $id est de type int est privé
    private ?int $id = null;

    ####################################################
    ######## CONFIGURATION DES CHAMPS DE LA BD #########
    ####################################################

    // 1. Contraintes de validation.
    // 2. privé donc accecible depuis la class Inscription.php

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom est obligatoire")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire")]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siret = null; // Non obligatoire

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'email est obligatoire")]
    #[Assert\Email(message: "Veuillez entrer un email valide")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le numéro de téléphone est obligatoire")]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire")]
    #[Assert\Length(
        min: 8,
        minMessage: "Le mot de passe doit faire au moins {{ limit }} caractères."   
    )]
    private ?string $password = null;

    // Methode pour récuperer la valeur depuis l'exterieur de la classe Inscription.php
    // Get = Récuperer Set = Définir.
    // Si la valeur n'est pas renseignée, renvoie null.
    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getNom(): ?string
    {
        return $this -> nom;
    }

    public function setNom(string $nom): self
    {
        $this -> nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this -> prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this -> prenom = $prenom;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this -> email;
    }

    public function setEmail(string $email): self
    {
        $this -> email = $email;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this -> telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this -> telephone = $telephone;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this -> password;
    }

    public function setPassword(string $password): self
    {
        $this -> password = $password;
        return $this;
    }
}
