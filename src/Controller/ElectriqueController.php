<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElectriqueController extends AbstractController
{
    #[Route('/electrique', name: 'app_electrique')]
    public function index(): Response
    {
        return $this->render('electrique/index.html.twig', [
            'controller_name' => 'ElectriqueController',
        ]);
    }
}
