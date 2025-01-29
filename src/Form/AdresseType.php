<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Fournisseur;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            -> add(
                'adresse_libelle'
            )

            -> add(
                'adresse_ville'
            )

            -> add(
                'adresse_postal'
            )

            -> add(
                'adresse_type'
            
            )

            -> add(
                'adresse_telephone'
            
            )

            -> add(
                'fournisseur', 
                EntityType::class,
                [
                    'class' => Fournisseur::class,
                    'choice_label' => 'id',
                ]
            )

            -> add(
                'utilisateur', 
                EntityType::class, 
                [
                    'class' => Utilisateur::class,
                    'choice_label' => 'id',
                ]
            )

            -> add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Je valide mes informations',
                    'attr' => 
                    [
                        'class' => 'btn btn-light'
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver -> setDefaults(
            [
                'data_class' => Adresse::class,
            ]
        );
    }
}
