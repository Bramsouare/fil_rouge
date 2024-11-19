<?php

namespace App\Entity;

use App\Repository\RubriqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RubriqueRepository::class)]
class Rubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $rubrique_libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $rubrique_image = null;

    #[ORM\Column(length: 255)]
    private ?string $rubrique_description = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'rubrique')]
    private ?self $rubrique = null;

    #[ORM\ManyToOne(inversedBy: 'rubrique')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getRubriqueLibelle(): ?string
    {
        return $this -> rubrique_libelle;
    }

    public function setRubriqueLibelle(string $rubrique_libelle): static
    {
        $this -> rubrique_libelle = $rubrique_libelle;

        return $this;
    }

    public function getRubriqueImage(): ?string
    {
        return $this -> rubrique_image;
    }

    public function setRubriqueImage(string $rubrique_image): static
    {
        $this -> rubrique_image = $rubrique_image;

        return $this;
    }

    public function getRubriqueDescription(): ?string
    {
        return $this -> rubrique_description;
    }

    public function setRubriqueDescription(string $rubrique_description): static
    {
        $this -> rubrique_description = $rubrique_description;

        return $this;
    }

    public function getRubrique(): ?self
    {
        return $this -> rubrique;
    }

    public function setRubrique(?self $rubrique): static
    {
        $this -> rubrique = $rubrique;

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
