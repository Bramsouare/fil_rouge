<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViolonController extends AbstractController
{
    #[Route('/violon', name: 'app_violon')]
    public function index(): Response
    {
        return $this->render('violon/index.html.twig', [
            'controller_name' => 'ViolonController',
        ]);
    }
}
