<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefinieController extends AbstractController
{
    #[Route('/definie', name: 'app_definie')]
    public function index(): Response
    {
        return $this->render('definie/index.html.twig', [
            'controller_name' => 'DefinieController',
        ]);
    }
}
