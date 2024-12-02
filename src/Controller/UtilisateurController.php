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

use function Symfony\Component\Clock\now;

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

        return $this -> render('utilisateur/connexion.html.twig', 
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

    
    // Écoute la route /inscription et lui associe le nom de la route 'app_inscription'
    public function inscription(Request $request, EntityManagerInterface $entityManager): Response
    {   

        // Création du formulaire
        $form = $this -> createForm(InscriptionType::class);

        // Traitement des données
        $form -> handleRequest ($request);

        // Vérifie si le form est soumis et valide
        if ($form -> isSubmitted() && $form -> isValid())
        {
            // Création de l'entité Utilisateur et de l'entité Adresse avec les données du formulaire
            $data = $form -> getData(); 
            $nom = $data['utilisateur_nom'];
            $prenom = $data['utilisateur_prenom'];
            $adresse_libelle = $data['adresse_libelle'];
            $adresse_ville = $data['adresse_ville'];
            $adresse_postal = $data['adresse_postal'];
            $utilisateur_mail = $data['utilisateur_mail'];
            $utilisateur_telephone = $data['utilisateur_telephone'];
            $utilisateur_mdp = $data['utilisateur_mdp'];

            $utilisateur = new Utilisateur();
            $utilisateur -> setUtilisateurNom($nom);
            $utilisateur -> setUtilisateurCoef('1');
            $utilisateur -> setUtilisateurDerniereCo(now());
            $utilisateur -> setUtilisateurVerifie(false);
            $utilisateur -> setUtilisateurPrenom($prenom);
            $utilisateur -> setUtilisateurMail($utilisateur_mail);
            $utilisateur -> setUtilisateurTelephone($utilisateur_telephone);
            $utilisateur -> setUtilisateurMdp($utilisateur_mdp);
            $utilisateur -> setUtilisateurReference(password_hash('$utilisateur_mail',PASSWORD_DEFAULT));
            

            $adresse = new Adresse();
            $adresse -> setAdresseLibelle($adresse_libelle);
            $adresse -> setUtilisateur($utilisateur);
            $adresse -> setAdresseVille($adresse_ville);
            $adresse -> setAdressePostal($adresse_postal);
            $adresse -> setAdresseType('1');
            $adresse -> setAdresseTelephone($utilisateur_telephone);

            // dump($adresse);
            // dd($utilisateur);

            // Persiste l'entité Utilisateur et l'entité Adresse
            $entityManager -> persist($utilisateur);
            $entityManager -> persist($adresse);

            // Sauvegarde les modifications
            $entityManager -> flush();

            // Redirige vers la page d'accueil
            return $this -> redirectToRoute('app_accueil');
        }

        // Affichage du formulaire 
        return $this -> render('utilisateur/inscription.html.twig',

            [
                // Création du formulaire et affichage du formulaire dans la vue
                'form'=> $form -> createView(),
            ])
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
                'utilisateur/panier.html.twig',
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
                '/utilisateur/confirmation_com.html.twig',
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
                '/utilisateur/confirmation_mail.html.twig',
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
  