<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Fournisseur>
     */
    #[ORM\ManyToMany(targetEntity: Fournisseur::class, mappedBy: 'adresse')]
    private Collection $fournisseurs;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'adresse')]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this -> fournisseurs = new ArrayCollection();
        $this -> utilisateurs = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Fournisseur>
     */
    public function getFournisseurs(): Collection
    {
        return $this -> fournisseurs;
    }

    public function addFournisseur(Fournisseur $fournisseur): static
    {
        if (!$this -> fournisseurs -> contains($fournisseur)) {
            $this -> fournisseurs -> add($fournisseur);
            $fournisseur -> addAdresse($this);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): static
    {
        if ($this -> fournisseurs -> removeElement($fournisseur)) {
            $fournisseur -> removeAdresse($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this -> utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this -> utilisateurs -> contains($utilisateur)) {
            $this -> utilisateurs -> add($utilisateur);
            $utilisateur -> addAdresse($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this -> utilisateurs -> removeElement($utilisateur)) {
            $utilisateur -> removeAdresse($this);
        }

        return $this;
    }
}
