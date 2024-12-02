<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogueController extends AbstractController
{
   
    /*###################################################################################################################################
        *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    ACCUEIL CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ###################################################################################################################################*/

    #[Route(
        '/',
        name: 'app_accueil'
        )
    ]
    public function accueil(): Response
    {
        return $this -> render
            (
                'catalogue/accueil.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                ]
            )
        ;
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CATEGORIES CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/categorie',
        name: 'app_categorie'
            )
        ]
    public function categorie(): Response
    {
        return $this -> render
            (
                'catalogue/categorie.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                ]
            )
        ;
    }

    

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      INSTRUMENT CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/instrument',
        name: 'app_instrument'
            )
        ]
    public function instrument(): Response
    {
        return $this -> render
            (
                'catalogue/instrument.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                ]
            )
        ;
    }

}
