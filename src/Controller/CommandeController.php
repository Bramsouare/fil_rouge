<?php

namespace App\Controller;

use App\Entity\Payement;
use App\Form\PayementType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



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
    // Récupération des données du formulaire
    public function payement(Request $Request): Response
    {
        // Création de l'entité
        $payement = new Payement();

        // Création du formulaire
        $form = $this -> createForm(PayementType::class, $payement);

        // traitement des données et vérification plus renplis les champs
        $form -> handleRequest($Request);

        // Si le formulaire est soumis et valide
        if ($form -> isSubmitted() && $form -> isValid())
        {
            // Redirection vers la page de confirmation
            return $this -> redirectToRoute('payment_success');
        }
        
        // Affichage du formulaire si il n'est pas soumis et valide
        return $this -> render
            (
                'payement/index.html.twig',
                [
                    'form' => $form -> createView(),
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
