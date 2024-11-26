<?php

namespace App\Entity;

use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoleRepository;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $role_type = null;

    #[ORM\Column(length: 255)]
    private ?string $role_niveau = null;

    #[ORM\OneToOne(mappedBy: 'role', cascade: ['persist', 'remove'])]
    private ?Utilisateur $utilisateur = null;


    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getRoleType(): ?string
    {
        return $this -> role_type;
    }

    public function setRoleType(string $role_type): static
    {
        $this -> role_type = $role_type;

        return $this;
    }

    public function getRoleNiveau(): ?string
    {
        return $this -> role_niveau;
    }

    public function setRoleNiveau(string $role_niveau): static
    {
        $this -> role_niveau = $role_niveau;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this -> utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): static
    {
        // set the owning side of the relation if necessary
        if ($utilisateur -> getRole() !== $this) {
            $utilisateur -> setRole($this);
        }

        $this -> utilisateur = $utilisateur;

        return $this;
    }
}
