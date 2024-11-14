<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
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
                'accueil/index.html.twig',
                [
                    'controller_name' => 'AccueilController',
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
                'categorie/index.html.twig',
                [
                    'controller_name' => 'CategorieController',
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
                'instrument/index.html.twig',
                [
                    'controller_name' => 'InstrumentController',
                ]
            )
        ;
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
};

