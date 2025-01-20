<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Produit')
            ->setEntityLabelInSingular('Produit')
            ->setPageTitle("index","Village Green Administration Gestions des Produits")
            ->setPaginatorPageSize(10);
        }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('produit_libelle'),
            // TODO
            // TextField::new('rubrique'),
            // TextField::new('fournisseur'),
            // TextField::new('tva'),
            TextField::new('produit_description'),
            TextField::new('produit_prix_ht'),
            TextField::new('produit_reference'),
            TextField::new('produit_image'),
            BooleanField::new('produit_actif'),
            TextField::new('produit_stock'),
        ];
    }
    
}
