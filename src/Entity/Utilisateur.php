<?php

namespace App\Entity;
// gérer les opérations de base de données de la classe Utilisateur.
use App\Repository\UtilisateurRepository; 
// Object-Relational Mapper) afin de spécifier les métadonnées des colonnes et les relations.
use Doctrine\ORM\Mapping as ORM;
// Contient des contraintes de validation qui seront appliquées lors de la validation des données. 
use Symfony\Component\Validator\Constraints as Assert;


class Utilisateur
{
    // Indique que $id est la clé primaire de la table de base de données.
    #[ORM\Id]
    // valeur de $id est auto-incrémentée par la base de données.
    #[ORM\GeneratedValue]
    // $id est une colonne de la table associée dans la base de données.
    #[ORM\Column]
    // $id est de type int (entier), initialisée à null par défaut et ne peut être accédée directement que depuis la classe.
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    // Contrainte pour l'email.
    #[Assert\NotBlank(message:"Le nom ne peut pas être vide")]
    #[Assert\Email(message:"Veuillez entrer une adresse email valide")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    // Contrainte pour le mot de passe.
    #[Assert\NotBlank(message:"Le mot de passe ne peut pas être vide")]
    #[Assert\Length(
            min: 8,
            minMessage: "Le mot de passe doit faire au moins {{ limit }} caractères."   
        )
    ]

    private ?string $password = null;

    // Cela permet d’accéder à $id depuis l'extérieur de la classe.
    public function getId(): ?int
    {
        return $this -> id;
    }

    // getEmail() : Un getter pour obtenir la valeur de $email.
    // setEmail() : Un setter pour définir la valeur de $email. 
    // Il prend en paramètre un string $email et retourne l’instance de l’objet 
    // (self), permettant le chaînage des appels.

    public function getEmail(): ?string
    {
        return $this -> email;
    }

    public function setEmail(string $email): self
    {
        $this -> email = $email;    
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