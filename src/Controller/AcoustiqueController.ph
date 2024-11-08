<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcoustiqueController extends AbstractController
{
    #[Route('/acoustique', name: 'app_acoustique')]
    public function index(): Response
    {
        return $this->render('acoustique/index.html.twig', [
            'controller_name' => 'AcoustiqueController',
        ]);
    }
}
