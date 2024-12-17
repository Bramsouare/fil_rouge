<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class AuthentificationController extends AbstractController
{
    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONNEXION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/utilisateur',
        name: 'utilisateur_form'
        )
    ]
    public function connexion(AuthenticationUtils $authenticationUtils, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupère les erreurs d'authentification et le dernier nom d'utilisateur saisi
        $error = $authenticationUtils -> getLastAuthenticationError();

        // Récupère le dernier nom d'utilisateur saisi
        $nom_utilisateur = $authenticationUtils -> getLastUsername();

        // Crée un formulaire de connexion et affiche la page de connexion
        $form = $this -> createForm(UtilisateurType::class);

        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid())
        {
            $email = $form -> get('utilisateur_mail') -> getData();
            $utilisateur = $entityManager -> getRepository(Utilisateur::class) -> findBy(['utilisateur_mail' => $email]);

            if (count($utilisateur) > 0)
            {
                $this -> addFlash('error', 'Ce mail existe deja');
                return $this -> redirectToRoute('app_inscription');
            }

            return $this -> redirectToRoute('app_accueil');
        }

        return $this -> render
            (
                'utilisateur/connexion.html.twig',
                [
                    
                    'last_username' => $nom_utilisateur,
                    'error' => $error,
                    'form' => $form 
                ]
            )
        ;
    }
}
