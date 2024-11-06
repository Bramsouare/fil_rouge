<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppartientController extends AbstractController
{
    #[Route('/appartient', name: 'app_appartient')]
    public function index(): Response
    {
        return $this->render('appartient/index.html.twig', [
            'controller_name' => 'AppartientController',
        ]);
    }
}
