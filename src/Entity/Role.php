<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'role')]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this -> utilisateurs = new ArrayCollection();
    }

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
            $utilisateur -> addRole($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this -> utilisateurs -> removeElement($utilisateur)) {
            $utilisateur -> removeRole($this);
        }

        return $this;
    }
}
