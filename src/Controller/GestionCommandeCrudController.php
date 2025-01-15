<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GestionCommandeCrudController extends AbstractController
{
    #[Route('/gestion/commande/crud', name: 'app_gestion_commande_crud')]
    public function index(): Response
    {
        return $this->render('gestion_commande_crud/index.html.twig', [
            'controller_name' => 'GestionCommandeCrudController',
        ]);
    }
}

// Permettrait de gérer les commandes.

//     Suivre l'état des commandes (en attente, en cours, expédiée).
//     Modifier les informations de facturation/livraison.
//     Valider ou annuler des commandes.