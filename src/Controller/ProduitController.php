<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]

    public function index(): Response
    {
        return $this -> render(

            'produit/index.html.twig', 
            [
                'controller_name' => 'ProduitController',
            ]
        );
    }

     /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      PRODUIT CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/produit',
        name: 'app_produit'
            )
        ]
    public function produit(): Response
    {
        return $this -> render
            (
                'produit/index.html.twig',
                [
                    'controller_name' => 'ProduitController',
                ]
            )
        ;
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      RUBRIQUE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/rubrique',
        name: 'app_rubrique'
            )
        ]
    public function rubrique(): Response
    {
        return $this -> render
            (
                'rubrique/index.html.twig',
                [
                    'controller_name' => 'RubriqueController',
                ]
            )
        ;
    }
}
