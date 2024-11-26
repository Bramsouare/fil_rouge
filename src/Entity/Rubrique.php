<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RubriqueRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'rubrique', orphanRemoval: true)]
    private Collection $produit;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'parent')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $rubrique = null;

    public function __construct()
    {
        $this -> produit = new ArrayCollection();
    }

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


    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this -> produit;
    }

    public function addProduit(Produit $idProduit): static
    {
        if (!$this -> produit -> contains($idProduit)) {
            $this -> produit -> add($idProduit);
            $idProduit -> setRubrique($this);
        }

        return $this;
    }

    public function removeProduit(Produit $idProduit): static
    {
        if ($this -> produit -> removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit -> getRubrique() === $this) {
                $idProduit -> setRubrique(null);
            }
        }

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

}
