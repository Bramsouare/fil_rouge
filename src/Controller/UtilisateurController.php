<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Form\UtilisateurType;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class UtilisateurController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier) {}

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONNEXION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/


    // CRÉATION ET GESTION DE FORMULAIRE
    // Utilise les fonctions de la classe AbstractController: création et gestion du formulaire
    #[
        Route(
            path: '/connexion',
            name: 'app_connexion'
        )
    ]

    public function connexion(

        Request $request,
        EntityManagerInterface $entityManager,
    ): Response 

    {
        // Création du formulaire pour l'inscription utilisateur
        $form = $this -> createForm(UtilisateurType::class);

        // Traitement des données
        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) 
        {
            // Récupérer les données du formulaire
            $dataForm = $form -> getData();
            $mailForm = $dataForm["utilisateur_mail"];
            $mdpForm = $dataForm ['utilisateur_mdp'];


            $existe = $entityManager -> getRepository(Utilisateur::class)
            
                -> findBy(['utilisateur_mail' => $mailForm,'utilisateur_mdp' => $mdpForm ])
            ;
               
            // si le mail est correct ET que le mdp est correct alors
            if ($dataForm === $mailForm & $dataForm === $mdpForm)
            {
                // si le mot de passe est correct alors
                if ($mdpForm === $dataForm)
                {
                    // on se connecte
                    return $this -> redirectToRoute('app_accueil');
                }
            }
            elseif ($dataForm !== $mailForm || $dataForm !== $mdpForm)
            {
                $this -> addFlash('error', 'Veuillez entrée un e-mail ou le mot de passe valide !');
                return $this -> redirectToRoute('app_connexion');
            }

// envoyer derniere date de connexion à la base de donnée

            
            
        }
        
        return $this -> render('utilisateur/connexion.html.twig',
        [
            'form' => $form -> createView(),
        ]);
    }
    // TRAITEMENT DES BOUTON ( BTN DE CONNEXION ET BTN DE DÉCONNEXION)

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils -> getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils -> getLastUsername();

        return $this -> render('security/connexion.html.twig', 
        [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode est interceptée par Symfony via le pare-feu dans security.yaml.
        throw new \LogicException('Cette méthode peut être vide.');
    }
    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      INSCRIPTION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~                     
    ####################################################################################################################################*/

    // CRÉATION ET GESTION DE FORMULAIRE

    #[
        Route(
            '/inscription',
            name: 'app_inscription',

        )
    ]    

    // Les données de l'user permettant d'interagire avec la bd
    public function index(Request $request, Security $security, EntityManagerInterface $entityManager): Response
    {

        // Création du formulaire
        $form = $this -> createForm(InscriptionType::class);

        // Récupère les données soumises
        $form -> handleRequest($request);

        // Vérifie si le form est soumis et valide
        if ($form -> isSubmitted() && $form -> isValid()) 
        {
            // vérifie si le mail est unique dans la bd
            $email = $form -> getData(['utilisateur_mail']);
            $utilisateur = $entityManager -> getRepository(Utilisateur::class) -> findBy(['utilisateur_mail' => $email]);

            // Si le mail est unique alors on redirige vers la page de connexion
            if (count($utilisateur) > 0) 
            {
                $this -> addFlash('error', 'Ce mail existe deja');
                return $this -> redirectToRoute('app_connexion');
            }

            // Création de l'entité Utilisateur et de l'entité Adresse avec les données du formulaire

            $data = $form -> getData(); // Récupère les donées du form
            $nom = $data['utilisateur_nom']; 
            $prenom = $data['utilisateur_prenom'];
            $adresse_libelle = $data['adresse_libelle'];
            $adresse_ville = $data['adresse_ville'];
            $adresse_postal = $data['adresse_postal'];
            $utilisateur_mail = $data['utilisateur_mail'];
            $utilisateur_telephone = $data['utilisateur_telephone'];
            $utilisateur_mdp = password_hash($data['utilisateur_mdp'], PASSWORD_DEFAULT);

            $utilisateur = new Utilisateur();
            $utilisateur -> setUtilisateurNom($nom);
            $utilisateur -> setUtilisateurCoef('1');
            $utilisateur -> setUtilisateurDerniereCo(new \DateTime());
            $utilisateur -> setVerified(false);
            $utilisateur -> setUtilisateurPrenom($prenom);
            $utilisateur -> setUtilisateurMail($utilisateur_mail);
            $utilisateur -> setUtilisateurTelephone($utilisateur_telephone);
            $utilisateur -> setUtilisateurReference($utilisateur_mail);
            $utilisateur -> setUtilisateurMdp($utilisateur_mdp );


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

            // Prépare l'entité Utilisateur et l'entité Adresse pour la bd
            $entityManager -> persist($utilisateur);
            $entityManager -> persist($adresse);

            // Sauvegarde les modifications en base
            $entityManager -> flush();

            // Envoie de l'email de confirmation d'adresse  
            $this -> emailVerifier -> sendEmailConfirmation(
                'app_verify_email',
                $utilisateur,

                // Création de l'email
                (new TemplatedEmail())

                    // Paramètres de l'email
                    -> from(new Address('contact@villagegreen.com', 'villagegreen support'))
                    -> to((string) $utilisateur -> getUtilisateurMail())
                    -> subject('Confirmation du mail')
                    -> htmlTemplate(
                        'mail/confirmation_email.html.twig'
                    )
            );

            // Redirige vers la page d'accueil
            return $this -> redirectToRoute('app_accueil');
        }

        // Affichage du formulaire 
        return $this -> render(
            'utilisateur/inscription.html.twig',

            [
                // Création du formulaire et affichage du formulaire dans la vue
                'form' => $form -> createView(),
            ]
        );
    }

    // Définit la route pour vérifier l'adresse email après réception du lien.
    #[
        Route(
            '/verify/email',
            name: 'app_verify_email'
        )
    ]

    
    public function verifyUserEmail(

        // Paramètres de la route /verify/email 
        Request $request,
        TranslatorInterface $translator,
        UtilisateurRepository $utilisateurRepository
    ): Response 
    
    {
        // ID transmit dans le lien
        $id = $request -> query -> get('id');
        // Recherche de l'user avec l'id
        $user = $utilisateurRepository -> find($id);

        if (null === $id || null === $user) 
        {
            return $this -> redirectToRoute('app_inscription');
        }

        // Gestion d'erreur
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

                    [],
                    'VerifyEmailBundle'
                )
            );

            return $this -> redirectToRoute('app_inscription');
        }

        // Message flash de confirmation d'adresse 
        $this -> addFlash('success', 'Ton adresse est vérifier.');

        return $this -> redirectToRoute('app_accueil');
    }
    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      COMMANDE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    // #[
    //     Route(
    //         '/commande',
    //         name: 'app_commande',
    //     )
    // ]
    // public function commande(): Response
    // {
    //     return $this->render(
    //             'commande/index.html.twig',
    //             [
    //                 'controller_name' => 'UtilisateurController',
    //             ]
    //         );
    // }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     PANIER CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    // #[
    //     Route(
    //         '/panier',
    //         name: 'app_panier',
    //     )
    // ]
    // public function panier(): Response
    // {
    //     return $this->render(
    //             'utilisateur/panier.html.twig',
    //             [
    //                 'controller_name' => 'UtilisateurController',
    //             ]
    //         );
    // }

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

    // #[
    //     Route(
    //         '/facture',
    //         name: 'app_facture',
    //     )
    // ]
    // public function facture(): Response
    // {
    //     return $this->render(
    //             'facture/index.html.twig',
    //             [
    //                 'controller_name' => 'UtilisateurController',
    //             ]
    //         );
    // }



    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      LIVRAISON CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/
    // #[
    //     Route(
    //         '/livraison',
    //         name: 'app_livraison',
    //     )
    // ]
    // public function livraison(): Response
    // {
    //     return $this->render(
    //             'livraison/index.html.twig',
    //             [
    //                 'controller_name' => 'UtilisateurController',
    //             ]
    //         );
    // }


}
