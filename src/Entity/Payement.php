<?php

namespace App\Entity;
// Gestion des opérations de recherche de bd de la classe récupérer, manipuler et gérer les objets Payement.
use App\Repository\PayementRepository;
// Liaison des attributs avec la table de la bd.
use Doctrine\ORM\Mapping as ORM;
// Marquer la classe comme une entité de Doctrine, qui correspond au table de la bd.
#[ORM\Entity(repositoryClass: PayementRepository::class)]
class Payement
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

    #[ORM\Column(type: "string")]
    private ?string $nom = null;

    #[ORM\Column(type: "string")]
    private ?string $prenom = null;

    #[ORM\Column(type: "string")]
    private ?string $adresse = null;

    #[ORM\Column(type: "string")]
    private ?string $cartebancaire = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $dateexpiration = null;

    #[ORM\Column(type: "string")]
    private ?string $codeverification = null;

    // Methode pour récuperer la valeur depuis l'exterieur de la classe Payement.php
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

    public function getAdresse(): ?string
    {
        return $this -> adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this -> adresse = $adresse;
        return $this;
    }

    public function getCartebancaire(): ?string
    {
        return $this -> cartebancaire;
    }

    public function setCartebancaire(string $cartebancaire): self
    {
        $this -> cartebancaire = $cartebancaire;
        return $this;
    }

    public function getDateexpiration(): ?\DateTimeInterface
    {
        return $this -> dateexpiration;
    }

    public function setDateexpiration(\DateTimeInterface $dateexpiration): self
    {
        $this -> dateexpiration = $dateexpiration;
        return $this;
    }

    public function getCodeverification(): ?string
    {
        return $this -> codeverification;
    }

    public function setCodeverification(string $codeverification): self
    {
        $this -> codeverification = $codeverification;
        return $this;
    }
}
