<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            -> add(
                'utilisateur_prenom',
                TextType::class,
                [
                    'label' => 'Prénom'
                ]
            )

            -> add(
                'utilisateur_nom',
                TextType::class,
                [
                    'label' => 'Nom'
                ]
            )

            -> add(
                'utilisateur_mail',
                TextType::class,
                [
                    'label' => 'Email'
                ]
            )

            -> add(
                'utilisateur_mdp',
                PasswordType::class,
                [
                    'label' => 'Mots de passe'
                ]
            )

            -> add(
                'utilisateur_telephone',
                TextType::class,
                [
                    'label' => 'Téléphone'
                ]
            )

            -> add(
                'utilisateur_adresse',
                EntityType::class,
                [
                    'class' => Adresse::class, // L'entité cible
                    'choice_label' => 'adresse_libelle', // La propriété à afficher dans le formulaire
                    'label' => 'Adresse',
                    'expanded' => false, // Mettre true pour afficher comme des cases à cocher
                ]
            )
            

            -> add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Inscription',
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
                'data_class' => Utilisateur::class,
            ]
        );
    }
}
