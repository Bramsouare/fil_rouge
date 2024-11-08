<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BatterieController extends AbstractController
{
    #[Route('/batterie', name: 'app_batterie')]
    public function index(): Response
    {
        return $this->render('batterie/index.html.twig', [
            'controller_name' => 'BatterieController',
        ]);
    }
}
