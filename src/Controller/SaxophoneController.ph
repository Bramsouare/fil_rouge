<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaxophoneController extends AbstractController
{
    #[Route('/saxophone', name: 'app_saxophone')]
    public function index(): Response
    {
        return $this->render('saxophone/index.html.twig', [
            'controller_name' => 'SaxophoneController',
        ]);
    }
}
