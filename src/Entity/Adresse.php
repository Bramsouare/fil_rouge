<?php

namespace App\Entity;

use App\Entity\Fournisseur;
use App\Repository\AdresseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]

class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_ville = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $adresse_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_type = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_telephone = null;

    #[ORM\ManyToOne(inversedBy: 'adresse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateur_adresse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;


    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getAdresseLibelle(): ?string
    {
        return $this -> adresse_libelle;
    }

    public function setAdresseLibelle(string $adresse_libelle): static
    {
        $this -> adresse_libelle = $adresse_libelle;

        return $this;
    }

    public function getAdresseVille(): ?string
    {
        return $this -> adresse_ville;
    }

    public function setAdresseVille(string $adresse_ville): static
    {
        $this -> adresse_ville = $adresse_ville;

        return $this;
    }

    public function getAdressePostal(): ?int
    {
        return $this -> adresse_postal;
    }

    public function setAdressePostal(int $adresse_postal): static
    {
        $this -> adresse_postal = $adresse_postal;

        return $this;
    }

    public function getAdresseType(): ?string
    {
        return $this -> adresse_type;
    }

    public function setAdresseType(string $adresse_type): static
    {
        $this -> adresse_type = $adresse_type;

        return $this;
    }

    public function getAdresseTelephone(): ?string
    {
        return $this -> adresse_telephone;
    }

    public function setAdresseTelephone(string $adresse_telephone): static
    {
        $this -> adresse_telephone = $adresse_telephone;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this -> fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this -> fournisseur = $fournisseur;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

}
