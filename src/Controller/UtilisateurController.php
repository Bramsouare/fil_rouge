<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Utilisateur;

/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      UTILISATEUR CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

// CRÉATION ET GESTION DE FORMULAIRE
class UtilisateurController extends AbstractController
{
    // Utilise les fonctions de la classe AbstractController: création et gestion du formulaire
    #[Route(
        '/utilisateur', 
        name: 'utilisateur_form'
        )
    ]

    // Écoute la route /utilisateur et lui associe le nom de la route 'utilisateur_form'
    public function index(Request $request): Response
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
};
  

/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      ROLE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class RoleController extends AbstractController
{
    #[Route(
    '/role',
    name: 'app_role'
        )
    ]
    public function index(): Response
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
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      INSCRIPTION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~                     
####################################################################################################################################*/

// CRÉATION ET GESTION DE FORMULAIRE

// Utilise les fonctions de la classe AbstractController: création et gestion du formulaire
class InscriptionController extends AbstractController
{
    #[Route(
        '/inscription',
        name: 'app_inscription'
        )
    ]

    //Écoute la route /inscription et lui associe le nom de la route 'app_inscription'
    public function index(Request $request): Response
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

        return $this -> render('inscription/index.html.twig',
            [
                'controller_name' => 'InscriptionController',
            ]
            )
        ;
    }
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      ADRESSE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class AdresseController extends AbstractController
{
    #[Route(
        '/adresse',
        name: 'app_adresse'
        )
    ]
    public function index(): Response
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
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONNECTION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class ConnectionController extends AbstractController
{
    #[Route(
        '/connection',
        name: 'app_connection'
        )
    ]
    public function index(): Response
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
};


/*####################################################################################################################################
*                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      FOURNISSEUR CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####################################################################################################################################*/

class FournisseurController extends AbstractController 
{
    #[Route(
        '/fournisseur',
        name: 'app_fournisseur'
        )
    ]
    public function index(): Response
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
