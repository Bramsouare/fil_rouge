<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BeneficieController extends AbstractController
{
    #[Route('/beneficie', name: 'app_beneficie')]
    public function index(): Response
    {
        return $this->render('beneficie/index.html.twig', [
            'controller_name' => 'BeneficieController',
        ]);
    }
}
