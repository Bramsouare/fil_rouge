<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            -> add(
                'nom',
                TextType::class,
                [
                    'label' => 'Nom',
                    'required' => true,
                ]
            )
            -> add(
                'prenom',
                TextType::class,
                [
                    'label' => 'Prénom',
                    'required' => true,
                ]
            )
            -> add(
                'siret',
                TextType::class,
                [
                    'label' => 'Numéro SIRET',
                    'required' => false,
                ]
            )
            -> add(
                'email',
                EmailType::class, 
                [
                    'label' => 'Email',
                    'required' => true,
                ]
            )
            -> add(
                'telephone',
                TextType::class,
                [
                    'label' => 'Téléphone',
                    'required' => false,
                ]
            )
            -> add(
                'adresse',
                TextType::class,
                [
                    'label' => 'Adresse',
                    'required' => false,
                ]
            )
            -> add( 
                'password',
                PasswordType::class, 
                [
                    'label' => 'Mot de passe',
                    'required' => true,
                ]
            )
        ;
    }
    // Renvoie l'entité et le nom de la classe de l'entité
    public function configureOptions(OptionsResolver $resolver): void
    {
        // Les données du form mappée sur l'object de la classe lors de la soumission puis mise a jour.
        $resolver -> setDefaults(
            [
                'data_class' => Inscription::class,
            ]
        );
    }
}
