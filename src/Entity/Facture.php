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

    #[ORM\OneToOne(inversedBy: 'id_facture', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?commande $id_commande = null;

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

    public function getIdCommande(): ?commande
    {
        return $this->id_commande;
    }

    public function setIdCommande(commande $id_commande): static
    {
        $this->id_commande = $id_commande;

        return $this;
    }

   
}
