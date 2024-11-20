<?php

namespace App\Entity;

use App\Repository\TvaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TvaRepository::class)]
class Tva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $tva_taux = null;

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getTvaTaux(): ?string
    {
        return $this -> tva_taux;
    }

    public function setTvaTaux(string $tva_taux): static
    {
        $this -> tva_taux = $tva_taux;

        return $this;
    }
}
