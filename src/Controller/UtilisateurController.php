<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;




class UtilisateurController extends AbstractController
{
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
    public function inscription(Request $request): Response
    {  
        $form = $this -> createForm(InscriptionType::class);

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

        return $this -> render('inscription/index.html.twig',
        [
            'controller_name' => 'InscriptionController',
            'form'=> $form -> createView(),

            ]
        )
    ;

      
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      ROLE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/role',
        name: 'app_role'
            )
        ]
    public function role(): Response
    {
        return $this -> render
            (
                'role/index.html.twig',
                [
                    'controller_name' => 'RoleController',
                ]
            )
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
                    'controller_name' => 'AdresseController',
                ]
            )
        ;
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONNECTION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/connection',
        name: 'app_connection'
        )
    ]
    public function connection(): Response
    {
        return $this -> render
            (
                'connection/index.html.twig',
                [
                    'controller_name' => 'ConnectionController',
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
                    'controller_name' => 'FournisseurController',
                ]
            )
        ;
    }

};
  