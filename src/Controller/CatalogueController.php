<?php

namespace App\Controller;

use App\Entity\Rubrique;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogueController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function index(): Response
    {
        return $this->render('recherche/index.html.twig', [
            'controller_name' => 'RechercheController',
        ]);
    }


    /*###################################################################################################################################
        *                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~    ACCUEIL CONTROLLER    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ###################################################################################################################################*/

    #[Route(
        '/',
        name: 'app_accueil'
        )
    ]
    public function accueil(RubriqueRepository $repository, ProduitRepository $produitRepository): Response
    {
        $rubriques = $repository->findAll();
        // dd($rubriques);
        
        $produits = $produitRepository->findby(['produit_stock' => 5], null, 3);
        return $this -> render
            (
                'catalogue/accueil.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                    'rubriques' => $rubriques,
                    'produits' => $produits

                ]
            )
        ;
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      RUBRIQUES CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/rubrique/{id}',
        name: 'app_rubrique_produits'
            )
        ]
    public function produitRubrique(Rubrique $rubrique): Response
    {
        $produits = $rubrique->getProduit();
        //dd($produits);

        return $this -> render
            (
                'catalogue/produitsRubrique.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                    'rubrique' => $rubrique,
                    'produits' => $produits
                ]
            )
        ;
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CATEGORIES CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/categorie',
        name: 'app_categorie'
            )
        ]
    public function categorie(RubriqueRepository $repository): Response
    {
        return $this -> render
            (
                'catalogue/categorie.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                    'rubriques' => $repository->findAll()
                ]
            )
        ;
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      INSTRUMENT CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/instrument',
        name: 'app_instrument'
            )
        ]
    public function instrument(ProduitRepository $repository): Response
    {
        $produits = $repository->findAll();
        //dd($produits);

        return $this -> render
            (
                'catalogue/instrument.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                    'produits' => $produits
                ]
            )
        ;
    }


    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      CGU CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/cgu',
        name: 'app_cgu'
            )
        ]
    public function cgu(): Response
    {
       
        return $this -> render
            (
                'catalogue/cgu.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                ]
            )
        ;
    }

    /*####################################################################################################################################
    *           ~~~~~~~~~~~~~~~~~~~~~~~~~~~~      POLITIQUE DE CONFIDENTIALITÉ CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/politiqueConf',
        name: 'app_politiqueConf'
            )
        ]
    public function politiqueConf(): Response
    {
        
        return $this -> render
            (
                'catalogue/politiqueConf.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                ]
            )
        ;
    }

    /*####################################################################################################################################
    *                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~      MENTIONS LÉGALES CONTROLLER     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ####################################################################################################################################*/

    #[Route(
        '/mentionsLegales',
        name: 'app_mentionsLegales'
            )
        ]
    public function mentionsLegales(): Response
    {
       
        return $this -> render
            (
                'catalogue/mentionsLegales.html.twig',
                [
                    'controller_name' => 'CatalogueController',
                ]
            )
        ;
    }

}
