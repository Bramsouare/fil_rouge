<?php 
namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            -> add(
                    'email',
                    EmailType::class, 
                    [
                        'label' => 'Email',
                        'required' => true,
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
                'dara_class' => Utilisateur::class,
            ]
    );
    }
}
