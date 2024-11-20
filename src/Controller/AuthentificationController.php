<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthentificationController extends AbstractController
{
    #[Route('/authentification', name: 'app_authentification')]

    public function index(): Response
    {
        return $this -> render(
            'authentification/index.html.twig', 
            [
                'controller_name' => 'AuthentificationController',
            ]
        );
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CONNECTION CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/connection',
        name: 'app_connection'
        )
    ]
    public function connection(): Response
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
}
