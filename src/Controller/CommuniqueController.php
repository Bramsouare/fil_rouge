<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommuniqueController extends AbstractController
{
    #[Route('/communique', name: 'app_communique')]
    public function index(): Response
    {
        return $this->render('communique/index.html.twig', [
            'controller_name' => 'CommuniqueController',
        ]);
    }
}
