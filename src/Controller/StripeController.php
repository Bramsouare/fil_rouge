<?php

namespace App\Controller;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class StripeController extends AbstractController
{
    /*###################################################################################################################################
        *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    STRIPE CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ###################################################################################################################################*/

    #[Route('/stripe', name: 'app_stripe')]
    public function index(): Response
    {
        return $this->render('stripe/index.html.twig', [
            'controller_name' => 'StripeController',
        ]);
    }

    /*###################################################################################################################################
        *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    SUCCESS CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ###################################################################################################################################*/


    #[Route('/success', name: 'success')]
    public function success(): Response
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

    public function checkout()
    {
        \Stripe\Stripe::setApiKey('sk_test_51QkMiAADlF7Q3OUjhJcYYIUvOwAyMcHgf7XXmbiFbvQGkm5FTKArURcDPUoCFSgjGYlVBToX44R0avE6c1uCCupS00bxsrdC7C');

        $session = \Stripe\Checkout\Session::create(
            [
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Instrument',
                        ],
                        'unit_amount' => 2000,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
                'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),

            ]
        );

        return new JsonResponse(['id' => $session->id ]);
    }
}

