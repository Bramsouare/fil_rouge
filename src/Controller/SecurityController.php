<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    #[Route(
        path: '/login', 
        name: 'app_login'
        )
    ]
    
    public function connexion(

        Request $request,
        EntityManagerInterface $entityManager,
        AuthenticationUtils $authenticationUtils

    ): Response 
    {

        // Erreur d'authentification 
        $error = $authenticationUtils -> getLastAuthenticationError();

        // Dernier nom d'utilisateur saisi 
        $lastUsername = $authenticationUtils -> getLastUsername();

        // Création du formulaire pour l'inscription utilisateur
        $form = $this -> createForm(UtilisateurType::class);

        // Traitement des données
        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) 
        {
            // Récupérer les données du formulaire
            /** @var Utilisateur $utilisateur */
            $utilisateur = $form -> getData();

            // Vérifier si l'email existe déjà
            $existe = $entityManager -> getRepository(Utilisateur::class)

            // Recherche de l'utilisateur par son email
            -> findOneBy(['utilisateur_mail' => $utilisateur -> getUtilisateurMail()]);

            if ($existe) 
            {
                $this -> addFlash('error', 'Cet email est déjà utilisé.');

                return $this -> redirectToRoute('app_login');
            }

            // Hachage du mot de passe
            $utilisateur -> setUtilisateurMdp(password_hash($utilisateur -> getUtilisateurMdp(), PASSWORD_DEFAULT));

            // Sauvegarde en base de données
            $entityManager -> persist($utilisateur);
            $entityManager -> flush();

            $this -> addFlash('success', 'Inscription réussie, vous pouvez maintenant vous connecter.');
            return $this -> redirectToRoute('app_accueil');
        }

        return $this -> render('security/login.html.twig', 
        [
            // Dernier nom d'utilisateur saisi
            'last_username' => $lastUsername,

            // Erreur d'authentification
            'error' => $error,

            // Formulaire
            'form' => $form -> createView(),
        ]);
    }
    

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode est interceptée par Symfony via le pare-feu dans security.yaml.
        throw new \LogicException('Cette méthode peut être vide.');
    }
}
