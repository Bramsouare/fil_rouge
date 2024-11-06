<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenereController extends AbstractController
{
    #[Route('/genere', name: 'app_genere')]
    public function index(): Response
    {
        return $this->render('genere/index.html.twig', [
            'controller_name' => 'GenereController',
        ]);
    }
}
