<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserCrudController extends AbstractController
{
    #[Route('/user/crud', name: 'app_user_crud')]
    public function index(): Response
    {
        return $this->render('user_crud/index.html.twig', [
            'controller_name' => 'UserCrudController',
        ]);
    }
}

// Permettrait de gérer les utilisateurs (clients particuliers, clients professionnels, administrateurs).

//     Ajouter/modifier les profils.
//     Attribuer des rôles (ROLE_USER, ROLE_ADMIN).
//     Ajuster les coefficients de prix pour les clients professionnels.