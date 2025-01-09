<?php

namespace App\Entity;

use App\Entity\Utilisateur;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoleRepository;

// La classe est une entité gérée par Doctrine et associée à la table correspondante en base de données.
#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    // Clés primaires de l'entité.
    #[ORM\Id]
    // Valeurs auto-générées.
    #[ORM\GeneratedValue]
    // Colonne de l'entité.
    #[ORM\Column]
    // Identifiant de l'entité.
    private ?int $id = null;

    // Colonne role_type 
    #[ORM\Column(length: 255)]
    private ?string $role_type = null;

// TODO  SUP Colonne role_niveau

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $role_niveau = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\OneToMany(targetEntity: Utilisateur::class, mappedBy: 'role', orphanRemoval: true)]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    ##########################################################################################
    # Méthodes getters et setters permettant de lire et modifier les propriétés de l'entité. #
    ##########################################################################################
    public function getId(): ?int
    {
        return $this -> id; // Retourne l'id du role
    }

    public function getRoleType(): ?string
    {
        return $this -> role_type; // Retourne le type de role
    }

    public function setRoleType(string $role_type): static
    {
        $this -> role_type = $role_type; // Modifie le type de role

        return $this; // Retourne l'objet actuel
    }

    public function getRoleNiveau(): ?string
    {
        return $this -> role_niveau; // Retourne le niveau de role
    }

    public function setRoleNiveau(string $role_niveau): static
    {
        $this -> role_niveau = $role_niveau; // Modifie le niveau de role

        return $this; // Retourne l'objet actuel
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setRole($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getRole() === $this) {
                $utilisateur->setRole(null);
            }
        }

        return $this;
    }

}
