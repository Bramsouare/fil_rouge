<?php

namespace App\Form;

use App\Entity\Payement;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType; 

class PayementType extends AbstractType
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
                    'label' => 'Prenom',
                    'required' => true,
                ]
            )
            -> add(
                'adresse',
                TextType::class,
                [
                    'label' => 'Adresse de l\'ivraison',
                    'required' => true,
                ]
            )
            -> add(
                'cartebancaire',
                TextType::class,
                [
                    'label' => 'Carte bancaire',
                    'required' => true,
                ]
            )
            -> add(
                'dateexpiration',
                DateType::class,  
                [
                    'label' => 'Date d\'expiration', 
                    'required' => true,
                ]
            )
            -> add(
                'codeverification',  
                TextType::class,
                [
                    'label' => 'Code de vérification',
                    'required' => true,
                ]
            )           
        ;
    }

    // Renvoie l'entité et le nom de la classe de l'entité
    public function configureOptions(OptionsResolver $resolver): void
    {
        // Les données du form mappée sur l'object de la classe lors de la soumission puis mise a jour.

        $resolver -> setDefaults([
            'data_class' => Payement::class,
        ]);
    }
}
