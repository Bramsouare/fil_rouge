<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class StripeController extends AbstractController
{
    /*###################################################################################################################################
        *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    STRIPE CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ###################################################################################################################################*/

    #[Route('/stripe', name: 'app_stripe')]
    public function index(): Response
    {
        return $this->render('stripe/index.html.twig', []);
    }

    /*###################################################################################################################################
        *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    SUCCESS CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ###################################################################################################################################*/


    #[Route('/success', name: 'success')]
    public function success(EntityManagerInterface $entityManager): Response
    {
        return $this->render('stripe/success.html.twig', []);
    }

    /*###################################################################################################################################
        *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    ERREUR CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ###################################################################################################################################*/



    #[Route('/error', name: 'error')]
    public function error(): Response
    {
        return $this->render('stripe/error.html.twig', []);
    }

    /*###################################################################################################################################
        *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    ACCUEIL CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ###################################################################################################################################*/

    #[Route('/create-checkout-session', name: 'app_checkout')]

    public function checkout(SessionInterface $session, EntityManagerInterface $entityManager)
    {
        \Stripe\Stripe::setApiKey($_ENV['CLE_SECRETE']);

        $domaine="https://127.0.0.1:8000";

        $individuel=[];

        $panier = $session->get('panier',[]);

        foreach ($panier as $id => $qty)
        {
            $produit = $entityManager->getRepository(Produit::class)->findOneBy(["id"=>$id]);

            $individuel[]= 
            [
                'price' => $produit->getPrix(),
                'quantity' => $qty,
            ];
        }
        
        $session = \Stripe\Checkout\Session::create(                                                                                                                                                  
    
            [
                'line_items' => $individuel,

                'mode' => 'payment',

                'automatic_tax' => 
                [
                    'enabled' => true,
                ],

                'success_url' => $domaine."/success",
                'cancel_url' => $domaine."/error",
            ]
        );

        return new RedirectResponse($session->url);
    }
}

