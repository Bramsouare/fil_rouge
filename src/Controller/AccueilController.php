<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/*###################################################################################################################################
    *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    ACCUEIL CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
###################################################################################################################################*/
class AccueilController extends AbstractController
{
    #[Route(
        '/accueil',
        name: 'app_accueil'
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'accueil/index.html.twig',
                [
                    'controller_name' => 'AccueilController',
                ]
            )
        ;
    }
}

/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CATEGORIES CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class CategorieController extends AbstractController
{
    #[Route(
    '/categorie',
    name: 'app_categorie'
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'categorie/index.html.twig',
                [
                    'controller_name' => 'CategorieController',
                ]
            )
        ;
    }
};

/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      INSTRUMENT CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

Class InstrumentController extends AbstractController
{
    #[Route(
    '/instrument',
    name: 'app_instrument'
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'instrument/index.html.twig',
                [
                    'controller_name' => 'InstrumentController',
                ]
            )
        ;
    }
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      PRODUIT CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class ProduitController extends AbstractController
{
    #[Route(
    '/produit',
    name: 'app_produit'
        )
    ]
    public function index(): Response
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
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      RUBRIQUE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class RubriqueController extends AbstractController
{
    #[Route(
    '/rubrique',
    name: 'app_rubrique'
        )
    ]
    public function index(): Response
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
};

