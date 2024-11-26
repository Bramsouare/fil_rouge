<?php

namespace App\Entity;

use App\Repository\RubriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, produit>
     */
    #[ORM\OneToMany(targetEntity: produit::class, mappedBy: 'id_rubrique', orphanRemoval: true)]
    private Collection $id_produit;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'id_parent')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $id_rubrique = null;

    public function __construct()
    {
        $this -> id_produit = new ArrayCollection();
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

    public function getRubrique(): ?self
    {
        return $this -> rubrique;
    }

    public function setRubrique(?self $rubrique): static
    {
        $this -> rubrique = $rubrique;

        return $this;
    }

    /**
     * @return Collection<int, produit>
     */
    public function getIdProduit(): Collection
    {
        return $this -> id_produit;
    }

    public function addIdProduit(produit $idProduit): static
    {
        if (!$this -> id_produit -> contains($idProduit)) {
            $this -> id_produit -> add($idProduit);
            $idProduit -> setIdRubrique($this);
        }

        return $this;
    }

    public function removeIdProduit(produit $idProduit): static
    {
        if ($this -> id_produit -> removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit -> getIdRubrique() === $this) {
                $idProduit -> setIdRubrique(null);
            }
        }

        return $this;
    }

    public function getIdRubrique(): ?self
    {
        return $this -> id_rubrique;
    }

    public function setIdRubrique(?self $id_rubrique): static
    {
        $this -> id_rubrique = $id_rubrique;

        return $this;
    }

}
