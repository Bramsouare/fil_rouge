<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur_siret = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur_nom = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur_telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur_mail = null;

    #[ORM\Column]
    private ?bool $fournisseur_constructeur = null;

    /**
     * @var Collection<int, adresse>
     */
    #[ORM\ManyToMany(targetEntity: adresse::class, inversedBy: 'fournisseurs')]
    private Collection $adresse;

    #[ORM\ManyToOne(inversedBy: 'fournisseur')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    public function __construct()
    {
        $this -> adresse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getFournisseurSiret(): ?string
    {
        return $this -> fournisseur_siret;
    }

    public function setFournisseurSiret(string $fournisseur_siret): static
    {
        $this -> fournisseur_siret = $fournisseur_siret;

        return $this;
    }

    public function getFournisseurNom(): ?string
    {
        return $this -> fournisseur_nom;
    }

    public function setFournisseurNom(string $fournisseur_nom): static
    {
        $this -> fournisseur_nom = $fournisseur_nom;

        return $this;
    }

    public function getFournisseurTelephone(): ?string
    {
        return $this -> fournisseur_telephone;
    }

    public function setFournisseurTelephone(string $fournisseur_telephone): static
    {
        $this -> fournisseur_telephone = $fournisseur_telephone;

        return $this;
    }

    public function getFournisseurMail(): ?string
    {
        return $this -> fournisseur_mail;
    }

    public function setFournisseurMail(string $fournisseur_mail): static
    {
        $this -> fournisseur_mail = $fournisseur_mail;

        return $this;
    }

    public function isFournisseurConstructeur(): ?bool
    {
        return $this -> fournisseur_constructeur;
    }

    public function setFournisseurConstructeur(bool $fournisseur_constructeur): static
    {
        $this -> fournisseur_constructeur = $fournisseur_constructeur;

        return $this;
    }

    /**
     * @return Collection<int, adresse>
     */
    public function getAdresse(): Collection
    {
        return $this -> adresse;
    }

    public function addAdresse(adresse $adresse): static
    {
        if (!$this -> adresse -> contains($adresse)) {
            $this -> adresse -> add($adresse);
        }

        return $this;
    }

    public function removeAdresse(adresse $adresse): static
    {
        $this -> adresse -> removeElement($adresse);

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this -> produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this -> produit = $produit;

        return $this;
    }
}
