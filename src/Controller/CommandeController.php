<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class CommandeController extends AbstractController
{

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      COMMANDE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/commande',
        name: 'app_commande',
        )
    ]
    public function commande(): Response
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

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     PANIER CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/panier',
        name: 'app_panier',
        )
    ]
    public function panier(): Response
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

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     PAYEMENT  CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/payement',
        name: 'app_payement',
        )
    ]
    public function payement(): Response
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

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      TVA CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/tva',
        name: 'app_tva',
        )
    ]
    public function tva(): Response
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

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      FACTURE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/facture',
        name: 'app_facture',
        )
    ]
    public function facture(): Response
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

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONFIRMATION DE COMMANDE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/confirmation/com',
        name: 'app_confirmation_com', 
        )
    ]
    public function confirmationcom(): Response
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

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     CONFFIRMATION DE MAIL CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/confirmation/mail',
        name: 'app_confirmation_mail',
        )
    ]
    public function confirmationmail(): Response
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


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      LIVRAISON CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/
    #[Route(
        '/livraison',
        name: 'app_livraison',
        )
    ]
    public function livraison(): Response
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
