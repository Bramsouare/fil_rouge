<?php

namespace App\Entity;

use App\Entity\Commande;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FactureRepository;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $facture_libelle = null;

    #[ORM\OneToOne(inversedBy: 'facture', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

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

    public function getCommande(): ?Commande
    {
        return $this -> commande;
    }

    public function setCommande(Commande $commande): static
    {
        $this -> commande = $commande;

        return $this;
    }

   
}
