<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      COMMANDE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class CommandeController extends AbstractController
{
    #[Route(
        '/commande',
        name: 'app_commande',
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                    'commande/index.html.twig',
                [
                    'controller_name' => 'CommandeController',
                ]
            )
        ;
    }
};

/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     PANIER CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class PanierController extends AbstractController
{
    #[Route(
        '/panier',
        name: 'app_panier',
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'panier/index.html.twig',
                [
                    'controller_name' => '  PanierController',
                ]
            )
        ;
    }
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     PAYEMENT  CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class PayementController extends AbstractController
{
    #[Route(
        '/payement',
        name: 'app_payement',
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'payement/index.html.twig',
                [
                    'controller_name' => 'PayementController',
                ]
            )
        ;
    }
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      TVA CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class TvaController extends AbstractController
{
    #[Route(
        '/tva',
        name: 'app_tva',
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'tva/index.html.twig',
                [
                    'controller_name' => 'TvaController',
                ]
            )
        ;
    }
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      FACTURE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class FactureController extends AbstractController
{
    #[Route(
        '/facture',
        name: 'app_facture',
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'facture/index.html.twig',
                [
                    'controller_name' => 'FactureController',
                ]
            )
        ;
    }
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONFIRMATION DE COMMANDE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class ConfirmationComController extends AbstractController
{
    #[Route(
        '/confirmation/com',
        name: 'app_confirmation_com', 
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'confirmation_com/index.html.twig',
                [
                    'controller_name' => 'ConfirmationComController',
                ]
            )
        ;
    }   
};

/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     CONFFIRMATION DE MAIL CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class ConfirmationMail extends AbstractController
{
    #[Route(
        '/confirmation/mail',
        name: 'app_confirmation_mail',
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'confirmation_mail/index.html.twig',
                [
                    'controller_name' => 'ConfirmationMailController',
                ]
            )
        ;
    }
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      LIVRAISON CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class LivraisonController extends AbstractController
{
    #[Route(
        '/livraison',
        name: 'app_livraison',
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'livraison/index.html.twig',
                [
                    'controller_name' => 'LivraisonController',
                ]
            )
        ;
    }
};
