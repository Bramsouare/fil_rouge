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

class UtilisateurController extends AbstractController
{
    #[Route(
        '/utilisateur', 
        name: 'utilisateur_form'
        )
    ]
    public function index(Request $request): Response
    {
        $form = $this -> createForm(UtilisateurType::class);

        $form -> handleRequest ($request);
        if ($form -> isSubmitted() && $form -> isValid()) 
        {
            // Traitement des données du formulaire ici (par exemple, enregistrement)
            $data = $form -> getData();

            // Ajoutez ici le code pour gérer les données, comme les sauvegarder en base de données
            // Par exemple :
            // $email = $data['email'];
            // $password = $data['password'];

            return $this -> redirectToRoute('app_success');
        }

        return $this -> render('utilisateur/index.html.twig', 
            [
                'form' => $form->createView(),
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

class InscriptionController extends AbstractController
{
    #[Route(
        '/inscription',
        name: 'app_inscription'
        )
    ]
    public function index(): Response
    {
        return $this -> render
            (
                'inscription/index.html.twig',
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
