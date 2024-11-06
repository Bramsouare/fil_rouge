<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObserveController extends AbstractController
{
    #[Route('/observe', name: 'app_observe')]
    public function index(): Response
    {
        return $this->render('observe/index.html.twig', [
            'controller_name' => 'ObserveController',
        ]);
    }
}
