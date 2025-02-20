<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Entity\Utilisateur;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    private $rubriqueRepository;

    public function __construct(RubriqueRepository $rubriqueRepository)
    {
        $this->rubriqueRepository = $rubriqueRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $rubriques = $this->rubriqueRepository->findAll();

        return $this->render('admin/dashboard.html.twig', [
            'rubriques' => $rubriques,
        ]);
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Village Green Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fa-solid fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Produit', 'fa-solid fa-guitar', Produit::class);
    }
}



// Un tableau de bord spécifique pour les employés internes (DashboardController) pourrait inclure :

//     Des liens vers toutes les ressources importantes pour eux :
//         Gestion des produits : Modifier les prix, ajouter de nouveaux produits.
//         Gestion des clients : Ajouter des clients, ajuster les coefficients.
//         Gestion des commandes : Suivre les expéditions, valider les paiements.
//     Affichage de statistiques spécifiques :
//         Chiffre d’affaires mensuel.
//         Produits les plus vendus.
//         Commandes en attente de traitement.