<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitCrudController extends AbstractController
{
    #[Route('/produit/crud', name: 'app_produit_crud')]
    public function index(): Response
    {
        return $this->render('produit_crud/index.html.twig', [
            'controller_name' => 'ProduitCrudController',
        ]);
    }
}

// Permettrait de gérer les produits du catalogue.

//     Ajouter/modifier des produits (nom, prix, stock, image).
//     Activer ou désactiver des produits.
//     Associer des produits à des catégories.