<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            -> add(
                'utilisateur_nom',
                TextType::class, 
                [
                    'label' => 'Nom',
                    'required' => true,
                ]
            )

            -> add(
                'utilisateur_prenom',
                TextType::class, 
                [
                    'label' => 'Prénom',
                    'required' => true,
                ]
            )

            -> add(
                'adresse_libelle',
                TextType::class, 
                [
                    'label' => 'Adresse',
                    'required' => true,
                ]
            )

            -> add(
                'adresse_ville',
                TextType::class, 
                [
                    'label' => 'Ville',
                    'required' => true,
                ]
            )

            -> add(
                'adresse_postal',
                NumberType::class, 
                [
                    'label' => 'Code postal',
                    'required' => true,
                ]
            )

            -> add(
                'utilisateur_mail',
                EmailType::class, 
                [
                    'label' => 'Email',
                    'required' => true,
                ]
            )

            -> add(
                'utilisateur_telephone',
                TelType::class, 
                [
                    'label' => 'Téléphone',
                    'required' => true,
                ]
            )
            
            ->add('utilisateur_mdp', PasswordType::class, [
                            // instead of being set onto the object directly,
                            // this is read and encoded in the controller
                            'label' => 'Mot de passe',
                            'required' => true,
                            'mapped' => false,
                            'attr' => ['autocomplete' => 'new-password'],
                            'constraints' => [
                                new NotBlank([
                                    'message' => 'Please enter a password',
                                ]),
                                new Length([
                                    'min' => 6,
                                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                                    // max length allowed by Symfony for security reasons
                                    'max' => 4096,
                                ]),
                            ],
                        ])
            -> add(
                'Envoyer', 
                SubmitType::class,
                [
                    'label' => "Je m'inscris",
                    'attr' => 
                    [
                        'class' => 'btn btn-light'
                    ]
                ]
            )
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver -> setDefaults([
            // 'data_class' => Utilisateur::class,
        ]);
    }
}
