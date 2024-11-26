<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\InscriptionType;
use App\Entity\Payement;
use App\Form\PayementType;
use App\Entity\Adresse;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\Curl\Util;


class UtilisateurController extends AbstractController
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
                    'controller_name' => 'UtilisateurController',
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
                    'controller_name' => 'UtilisateurController',
                ]
            )
        ;
    }

    
    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      UTILISATEUR CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/
    
    
    // CRÉATION ET GESTION DE FORMULAIRE
    // Utilise les fonctions de la classe AbstractController: création et gestion du formulaire
    #[Route(
        '/utilisateur', 
        name: 'utilisateur_form'
        )
    ]

    // Écoute la route /utilisateur et lui associe le nom de la route 'utilisateur_form'
    public function utilisateur(Request $request): Response
    {
        $form = $this -> createForm(UtilisateurType::class);

        $form -> handleRequest ($request);

        if ($form -> isSubmitted() && $form -> isValid()) 
        {
            // Vérifie si le form est soumis et valide
            $data = $form -> getData();

            // Ajoutez ici le code pour gérer les données, comme les sauvegarder en base de données
            // Par exemple :
            // $email = $data['email'];
            // $password = $data['password'];

            return $this -> redirectToRoute('app_accueil');
        }

        return $this -> render('utilisateur/index.html.twig', 
            [
                'form' => $form -> createView(),
            ]
            )
        ;
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      INSCRIPTION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~                     
    ####################################################################################################################################*/

    // CRÉATION ET GESTION DE FORMULAIRE

    #[Route(
        '/inscription',
        name: 'app_inscription'
        )
    ]

    //Écoute la route /inscription et lui associe le nom de la route 'app_inscription'
    public function inscription(Request $request, EntityManagerInterface $entityManager): Response
    {  
        $utilisateur = new Utilisateur();

        $form = $this -> createForm(InscriptionType::class, $utilisateur);

        $form -> handleRequest ($request);

        // Vérifie si le form est soumis et valide
        if ($form -> isSubmitted() && $form -> isValid())
        {
            $entityManager -> persist($utilisateur);
            $entityManager -> flush();

            // Ajoutez ici le code pour gérer les données, comme les sauvegarder en base de données
            // Par exemple :
            // $email = $data['email'];
            // $password = $data['password'];   

            return $this -> redirectToRoute('app_accueil');
        }

        return $this -> render('inscription/index.html.twig',
            [
                'form'=> $form -> createView(),
            ])
        ;
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      ADRESSE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/adresse',
        name: 'app_adresse'
        )
    ]
    public function adresse(): Response
    {
        return $this -> render
            (
                'adresse/index.html.twig',
                [
                    'controller_name' => 'UtilisateurController',
                ]
            )
        ;
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      FOURNISSEUR CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/fournisseur',
        name: 'app_fournisseur'
        )
    ]
    public function fournisseur(): Response
    {
        return $this -> render
            (
                'fournisseur/index.html.twig',
                [
                    'controller_name' => 'UtilisateurController',
                ]
            )
        ;
    }

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
                    'controller_name' => 'UtilisateurController',
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
                    'controller_name' => 'UtilisateurController',
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
                    'controller_name' => 'UtilisateurController',
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
                    'controller_name' => 'UtilisateurController',
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
                    'controller_name' => 'UtilisateurController',
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
                    'controller_name' => 'UtilisateurController',
                ]
            )
        ;
    }
}
  