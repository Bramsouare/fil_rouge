<?php

namespace App\Entity;

use App\Entity\Commande;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FactureRepository;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    // Clé primaire de l'entité
    #[ORM\Id]
    // Valeur auto incrementé
    #[ORM\GeneratedValue]
    // Colonne de la table
    #[ORM\Column] 
    // Id de la facture
    private ?int $id = null;

    // Libelle de la facture
    #[ORM\Column(length: 255)]
    private ?string $facture_libelle = null;

    // Relation entre la facture et la commande
    #[ORM\OneToOne(inversedBy: 'facture', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################

    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id de la facture
    }

    public function getFactureLibelle(): ?string
    {
        return $this -> facture_libelle; // Retourne le libelle de la facture
    }

    public function setFactureLibelle(string $facture_libelle): static
    {
        $this -> facture_libelle = $facture_libelle; // Modifie le libelle de la facture

        return $this; // Retourne l'objet actuel
    }

    public function getCommande(): ?Commande
    {
        return $this -> commande; // Retourne la commande
    }

    public function setCommande(Commande $commande): static
    {
        $this -> commande = $commande; // Modifie la commande

        return $this; // Retourne l'objet actuel
    }
   
}
