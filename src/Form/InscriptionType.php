<?php

namespace App\Form;

use App\Entity\adresse;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            -> add('utilisateur_prenom')
            -> add('utilisateur_nom')
            -> add('utilisateur_mail')
            -> add('utilisateur_mdp')
            -> add('utilisateur_telephone')
            -> add('adresse', EntityType::class, 
                [
                    'class' => adresse::class,
                    'choice_label' => 'id',
                    'multiple' => true,
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
