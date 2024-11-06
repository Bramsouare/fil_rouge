<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmationComController extends AbstractController
{
    #[Route('/confirmation/com', name: 'app_confirmation_com')]
    public function index(): Response
    {
        return $this->render('confirmation_com/index.html.twig', [
            'controller_name' => 'ConfirmationComController',
        ]);
    }
}
