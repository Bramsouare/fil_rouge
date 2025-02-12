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
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse_libelle', TextType::class, [
                'label' => 'Adresse (numéro et rue)',
                'attr' => ['placeholder' => 'Numéro et rue'],
            ])
            ->add('adresse_ville', TextType::class, [
                'label' => 'Ville',
                'attr' => ['placeholder' => 'Ville'],
            ])
            ->add('adresse_postal', TextType::class, [
                'label' => 'Code Postal',
                'attr' => ['placeholder' => 'Code Postal'],
            ])
            ->add('adresse_type', TextType::class, [
                'label' => 'Type d\'adresse (ex: domicile, travail)',
                'attr' => ['placeholder' => 'Type d\'adresse'],
            ])
            ->add('adresse_telephone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => ['placeholder' => 'Numéro de téléphone'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Je valide mes informations',
                'attr' => [
                    'class' => 'btn btn-light',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
