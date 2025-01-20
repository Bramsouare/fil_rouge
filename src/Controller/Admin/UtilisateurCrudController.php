<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateurs')
            ->setPageTitle("index","Village Green Administration des Utilisateurs")
            ->setPaginatorPageSize(10)
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('Utilisateur_nom'),
            TextField::new('Utilisateur_prenom'),
            TextField::new('Utilisateur_siret'),
            TextField::new('Utilisateur_mail')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('Utilisateur_reference')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('Utilisateur_telephone'),
            TextField::new('Utilisateur_coef'),
            DateTimeField::new('Utilisateur_derniere_co')
                ->setFormTypeOption('disabled', 'disabled'),
            ArrayField::new('roles'),
            
        ];
    }
    
}
