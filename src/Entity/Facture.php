<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $facture_libelle = null;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'facture')]
    private Collection $commandes;

    public function __construct()
    {
        $this -> commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getFactureLibelle(): ?string
    {
        return $this -> facture_libelle;
    }

    public function setFactureLibelle(string $facture_libelle): static
    {
        $this -> facture_libelle = $facture_libelle;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this -> commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this -> commandes -> contains($commande)) {
            $this -> commandes -> add($commande);
            $commande -> setFacture($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this -> commandes -> removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande -> getFacture() === $this) {
                $commande -> setFacture(null);
            }
        }

        return $this;
    }
}
