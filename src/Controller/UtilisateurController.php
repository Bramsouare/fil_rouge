<?php

namespace App\Controller;

use App\Entity\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use App\Entity\Adresse;
use App\Entity\Payement;
use App\Form\PayementType;
use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Form\UtilisateurType;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      UTILISATEUR CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/
    
    
    // CRÉATION ET GESTION DE FORMULAIRE
    // Utilise les fonctions de la classe AbstractController: création et gestion du formulaire
    // #[Route(
    //     '/utilisateur', 
    //     name: 'utilisateur_form'
    //     )
    // ]

    // // Écoute la route /utilisateur et lui associe le nom de la route 'utilisateur_form'
    // public function utilisateur(Request $request): Response
    // {
    //     $form = $this -> createForm(UtilisateurType::class);

    //     $form -> handleRequest ($request);

    //     if ($form -> isSubmitted() && $form -> isValid()) 
    //     {
    //         // Vérifie si le form est soumis et valide
    //         $data = $form -> getData();

    //         // Ajoutez ici le code pour gérer les données, comme les sauvegarder en base de données
    //         // Par exemple :
    //         // $email = $data['email'];
    //         // $password = $data['password'];

    //         return $this -> redirectToRoute('app_accueil');
    //     }

    //     return $this -> render('utilisateur/connexion.html.twig', 
    //         [
    //             'form' => $form -> createView(),
    //         ]
    //         )
    //     ;
    // }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      INSCRIPTION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~                     
    ####################################################################################################################################*/

    // CRÉATION ET GESTION DE FORMULAIRE

    #[Route(
        '/inscription',
        name: 'app_inscription',
        
        )
    ]
   
    // Écoute la route /inscription et lui associe le nom de la route 'app_inscription'
    public function inscription( Request $request,Security $security, EntityManagerInterface $entityManager, UserInterface $user): Response
    {   
        
        // Création du formulaire
        $form = $this -> createForm(InscriptionType::class);

        // Traitement des données
        $form -> handleRequest ($request);

        // Vérifie si le form est soumis et valide
        if ($form -> isSubmitted() && $form -> isValid())
        {
            // vérifie si le mail est unique
            $email = $form -> getData()['utilisateur_mail'];
            $utilisateur = $entityManager -> getRepository(Utilisateur::class) -> findBy(['utilisateur_mail' => $email]);

            // Si le mail est unique alors on redirige vers la page de connexion
            if (count($utilisateur) > 0)
            {
                $this -> addFlash('error', 'Ce mail existe deja');
                return $this -> redirectToRoute('app_inscription');
            }

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
            $utilisateur -> setUtilisateurDerniereCo(new \DateTime());
            $utilisateur -> setVerified(false);
            $utilisateur -> setUtilisateurPrenom($prenom);
            $utilisateur -> setUtilisateurMail($utilisateur_mail);
            $utilisateur -> setUtilisateurTelephone($utilisateur_telephone);
            $utilisateur -> setUtilisateurReference($utilisateur_mail);
            $utilisateur -> setUtilisateurMdp(password_hash('$utilisateur_mdp',PASSWORD_DEFAULT));
            

            $adresse = new Adresse();
            $adresse -> setAdresseLibelle($adresse_libelle);
            $adresse -> setUtilisateur($utilisateur);
            $adresse -> setAdresseVille($adresse_ville);
            $adresse -> setAdressePostal($adresse_postal);
            $adresse -> setAdresseType('1');
            $adresse -> setAdresseTelephone($utilisateur_telephone);
            $adresse -> setUtilisateur($utilisateur); // Lier l'adresse à l'utilisateur

            // dump($adresse);
            // dd($utilisateur);

            // Persiste l'entité Utilisateur et l'entité Adresse
            $entityManager -> persist($utilisateur);
            $entityManager -> persist($adresse);

            // Sauvegarde les modifications
            $entityManager -> flush();

            // Envoie de l'email de confirmation d'adresse  
            $this -> emailVerifier -> sendEmailConfirmation('app_verify_email', $utilisateur,

            // Création de l'email
            (new TemplatedEmail())

                // Paramètres de l'email
                -> from(new Address('contact@villagegreen.com', 'villagegreen support'))
                -> to((string) $utilisateur -> getUtilisateurMail())
                -> subject('Please Confirm your Email')
                -> htmlTemplate('registration/confirmation_email.html.twig'
            )
        );

        // Redirige vers la page de connexion
        return $security -> login($user, 'form_login', 'main');

        
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

    // CRÉATION ET GESTION DE FORMULAIRE
    #[Route(
        '/verify/email', 
        name: 'app_verify_email'
        )
    ]

    // Écoute la route /verify/email et lui associe le nom de la route 'app_verify_email'
    public function verifyUserEmail(

        // Paramètres de la route /verify/email 
        Request $request, TranslatorInterface $translator, 
        UtilisateurRepository $utilisateurRepository): Response
    {
        
        // 
        $id = $request -> query -> get('id');

        if (null === $id) 
        {
            return $this -> redirectToRoute('app_register');
        }

        $user = $utilisateurRepository -> find($id);

        if (null === $user) 
        {
            return $this -> redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try 
        {
            $this -> emailVerifier -> handleEmailConfirmation($request, $user);

        } 
        catch (VerifyEmailExceptionInterface $exception) 
        {
            $this -> addFlash(

                'verify_email_error', 

                $translator -> trans(

                $exception -> getReason(),

                [], 'VerifyEmailBundle')
            );

            return $this -> redirectToRoute('app_register');
        }

        // Message flash de confirmation d'adresse 
        $this -> addFlash('success', 'Your email address has been verified.');

        return $this -> redirectToRoute('app_register');
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

    // #[Route(
    //     '/payement',
    //     name: 'app_payement',
    //     )
    // ]
    // // Récupération des données du formulaire
    // public function payement(Request $Request): Response
    // {
    //     // Création de l'entité
    //     $payement = new Payement();

    //     // Création du formulaire
    //     $form = $this -> createForm(PayementType::class, $payement);

    //     // traitement des données et vérification plus renplis les champs
    //     $form -> handleRequest($Request);

    //     // Si le formulaire est soumis et valide
    //     if ($form -> isSubmitted() && $form -> isValid())
    //     {
    //         // Redirection vers la page de confirmation
    //         return $this -> redirectToRoute('payment_success');
    //     }
        
    //     // Affichage du formulaire si il n'est pas soumis et valide
    //     return $this -> render
    //         (
    //             'payement/index.html.twig',
    //             [
    //                 'form' => $form -> createView(),
    //             ]
    //         )
    //     ;
    // }


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
  