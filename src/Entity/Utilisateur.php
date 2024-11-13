<?php

namespace App\Entity;
// Gestion des opérations de recherche de bd de la classe récupérer, manipuler et gérer les objets Utilisateur.
use App\Repository\UtilisateurRepository; 
// Liaison des attributs avec la table de la bd.
use Doctrine\ORM\Mapping as ORM;
// Contraintes de validation lors de la validation des données. 
use Symfony\Component\Validator\Constraints as Assert;

// Marquer la classe comme une entité de Doctrine, qui correspond au table de la bd.
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]

class Utilisateur
{
    // $id est la clé primaire de la table de la bd.
    #[ORM\Id]
    // $id est auto-incrementée par la bd
    #[ORM\GeneratedValue]
    // $id est une colonne de la table associée de la bd.
    #[ORM\Column]
    // $id est de type int et privé
    private ?int $id = null;

    ####################################################
    ######## CONFIGURATION DES CHAMPS DE LA BD #########
    ####################################################

    // 1. Contraintes de validation.
    // 2. privé donc accecible depuis la class Utilisateur.php

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le mail ne peut pas être vide")]
    #[Assert\Email(message:"Veuillez entrer une adresse email valide")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le mot de passe ne peut pas être vide")]
    #[Assert\Length(
            min: 8,
            minMessage: "Le mot de passe doit faire au moins {{ limit }} caractères."   
        )
    ]
    private ?string $password = null;

    // Methode pour récuperer la valeur depuis l'exterieur de la classe Utilisateur.php
    // Get = Récuperer Set = Définir.
    // Si la valeur n'est pas renseignée, renvoie null.
    public function getId(): ?int
    {
        return $this -> id;
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