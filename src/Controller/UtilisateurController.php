<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\Adresse;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Repository\ProduitRepository;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class UtilisateurController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier) {}

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONNEXION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    // EX: debug
    // error_log(str_repeat('#', 80));
        // error_log(sprintf('YK [%s:%d] %s', __FILE__, __LINE__, $this->classOrAlias));
        
        // error_log(sprintf('YK [%s:%d] %s', __FILE__, __LINE__, get_class($repository)));
        // error_log(sprintf('YK [%s:%d] %s', __FILE__, __LINE__, $this->property));
        // error_log(sprintf('YK [%s:%d] %s', __FILE__, __LINE__, $identifier));
        // error_log(str_repeat('#', 80));
    // TRAITEMENT DES BOUTON ( BTN DE CONNEXION ET BTN DE DÉCONNEXION)

    /**
     * Fonction qui permet de traiter les requêtes HTTP de login
     *
     * @param AuthenticationUtils $authenticationUtils Objet d'un classe contenant des outils d'authentification
     */
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/connexion.html.twig',
            [
                'last_username' => $lastUsername,
                'error' => $error,
            ]
        );
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode est interceptée par Symfony via le pare-feu dans security.yaml.
        throw new \LogicException();
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
        $form = $this->createForm(InscriptionType::class);

        // Récupère les données soumises
        $form->handleRequest($request);

        // Vérifie si le form est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // vérifie si le mail est unique dans la bd
            $email = $form->getData(['utilisateur_mail']);
            $utilisateur = $entityManager->getRepository(Utilisateur::class)->findBy(['utilisateur_mail' => $email]);

            // Si le mail est unique alors on redirige vers la page de connexion
            if (count($utilisateur) > 0) {
                $this->addFlash('error', 'Ce mail existe deja');
                return $this->redirectToRoute('app_connexion');
            }

            // Création de l'entité Utilisateur et de l'entité Adresse avec les données du formulaire

            $data = $form->getData(); 
            $nom = $data['utilisateur_nom'];
            $prenom = $data['utilisateur_prenom'];
            $adresse_libelle = $data['adresse_libelle'];
            $adresse_ville = $data['adresse_ville'];
            $adresse_postal = $data['adresse_postal'];
            $utilisateur_mail = $data['utilisateur_mail'];
            $utilisateur_telephone = $data['utilisateur_telephone'];
            $utilisateur_mdp = password_hash($data['utilisateur_mdp'], PASSWORD_DEFAULT);

            $utilisateur = new Utilisateur();
            $utilisateur->setUtilisateurNom($nom);
            $utilisateur->setUtilisateurCoef('1');
            $utilisateur->setUtilisateurDerniereCo(new \DateTime());
            $utilisateur->setVerified(false);
            $utilisateur->setUtilisateurPrenom($prenom);
            $utilisateur->setUtilisateurMail($utilisateur_mail);
            $utilisateur->setUtilisateurTelephone($utilisateur_telephone);
            $utilisateur->setUtilisateurReference($utilisateur_mail);
            $utilisateur->setUtilisateurMdp($utilisateur_mdp);
            $role = $entityManager->getRepository(Role::class)->findOneBy(["role_type" => "Client"]);
            $utilisateur->setRole($role);


            $adresse = new Adresse();
            $adresse->setAdresseLibelle($adresse_libelle);
            $adresse->setAdressePostal($adresse_postal);
            $adresse->setAdresseType('1');
            $adresse->setAdresseTelephone($utilisateur_telephone);
            $adresse->setAdresseVille($adresse_ville);
            //   $adresse -> setUtilisateur($utilisateur); // Lier l'adresse à l'utilisateur

            // dump($adresse);
            // dd($utilisateur);

            // Prépare l'entité Utilisateur et l'entité Adresse pour la bd
            $entityManager->persist($utilisateur);
            $entityManager->persist($adresse);



            // Sauvegarde les modifications en base
            $entityManager->flush();

            // Envoie de l'email de confirmation d'adresse  
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $utilisateur,

                // Création de l'email
                (new TemplatedEmail())

                    // Paramètres de l'email
                    ->from(new Address('contact@villagegreen.com', 'villagegreen support'))
                    ->to((string) $utilisateur->getUtilisateurMail())
                    ->subject('Confirmation du mail')
                    ->htmlTemplate(
                        'mail/confirmation_email.html.twig'
                    )
            );

            // Redirige vers la page d'accueil
            return $this->redirectToRoute('app_accueil');
        }

        // Affichage du formulaire 
        return $this->render(
            'utilisateur/inscription.html.twig',

            [
                // Création du formulaire et affichage du formulaire dans la vue
                'form' => $form->createView(),
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
    ): Response {
        // ID transmit dans le lien
        $id = $request->query->get('id');
        // Recherche de l'user avec l'id
        $user = $utilisateurRepository->find($id);

        if (null === $id || null === $user) {
            return $this->redirectToRoute('app_inscription');
        }

        // Gestion d'erreur
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash(

                'verify_email_error',

                $translator->trans(

                    $exception->getReason(),

                    [],
                    'VerifyEmailBundle'
                )
            );

            return $this->redirectToRoute('app_inscription');
        }

        // Message flash de confirmation d'adresse 
        $this->addFlash('success', 'Ton adresse est vérifier.');

        return $this->redirectToRoute('app_accueil');
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      BIENVENUE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[
        Route(
            '/bienvenue',
            name: 'app_bienvenue',
        )
    ]
    public function bienvenue(): Response
    {
        return $this->render(
                'utilisateur/bienvenue.html.twig',
                [
                    'controller_name' => 'UtilisateurController',
                ]
            );
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONTACT CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[
        Route(
            '/contact',
            name: 'app_contact',
        )
    ]
    public function contact(): Response
    {
        return $this->render(
                'utilisateur/contact.html.twig',
                [
                    'controller_name' => 'UtilisateurController',
                ]
            );
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      COMMANDE CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[
        Route(
            '/commande',
            name: 'app_commande',
        )
    ]
    public function commande(): Response
    {
        return $this->render(
                'commande/index.html.twig',
                [
                    'controller_name' => 'UtilisateurController',
                ]
            );
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     PANIER CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[
        Route(
            '/panier',
            name: 'app_panier',
        )
    ]
    public function panier(SessionInterface $session, EntityManagerInterface $entityManager)
    {
        $panier = $session->get('panier', []);

        $panierData = [];

        foreach($panier as $id => $quantity)
        {
            $produit = $entityManager->getRepository(Produit::class)->find($id);

            if($produit)
            {
                $panierData[] = 
                [
                    'produit' => $produit,
                    'quantity' => $quantity,
                ];
            }
        }

        return $this->render(

            'utilisateur/panier.html.twig',
            [
                'items' => $panierData,
                'panier' => $panier,
            ]
        );
    }

    ################################################################
    #                   AJOUTER AU PANIER
    ################################################################

    #[
        route(
            '/panier/add/{id}',
            name: 'panier_add',
        )
    ]
    public function add($id, SessionInterface $session, EntityManagerInterface $entityManager)
    {
        $panier = $session->get('panier', []);
        
        $produit = $entityManager->getRepository(Produit::class)->findOneBy(['id' => $id]);

        if ($produit)
        {
            if (!empty($panier[$id]))
            {
                $panier[$id]++;
            }
            else
            {
                $panier[$id] = 1;
            }
        }
        
        $session->set('panier', $panier);

        // dd($session->get('panier'));

        return $this->redirectToRoute('app_panier');

    }

    ################################################################
    #                   SUPRIMER DU PANIER
    ################################################################

    #[
        route(
            '/panier/remove/{id}',
            name: 'panier_remove',
        )
    ]

    public function remove($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (isset($panier[$id]))
        {
            unset ($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier');
    }

    ################################################################
    #                   DÉCRÉMENTER LA QUANTITÉ
    ################################################################

    #[
        Route(
            '/panier/decrementer/{id}', 
            name: 'panier_decrementer'
        )
    ]

    public function decrementer($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) 
        {
            if ($panier[$id] > 1) 
            {
                $panier[$id]--;
                $this->addFlash('success', 'La quantité du produit a été réduit.');
            } 
            else 
            {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier');
    }

    ################################################################
    #                   INCRÉMENTER LA QUANTITÉ
    ################################################################

    #[
        Route(
            '/panier/incrementer/{id}', 
            name: 'panier_incrementer'
        )
    ]

    public function incrementer($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) 
        {
            $panier[$id]++;
            $this->addFlash('success', 'La quantité du produit a été augmentée.');

        }    
      
        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier');
    }

    ################################################################
    #                   MISE À JOUR DU PANIER
    ################################################################

    #[
        Route(
            '/panier/maj', 
            name: 'panier_maj'
        )
    
    ]

    public function maj(SessionInterface $session)
    {
        $session->set('panier', []);

        return $this->redirectToRoute('app_panier');
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
