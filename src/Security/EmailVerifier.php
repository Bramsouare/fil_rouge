<?php

namespace App\Security;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailVerifier
{
    // Fonctions de confirmation de l'adresse mail
    public function __construct(

        // Injection des services
        private VerifyEmailHelperInterface $verifyEmailHelper,
        private MailerInterface $mailer,
        private EntityManagerInterface $entityManager
    ) {
    }

    // Envoi du mail
    public function sendEmailConfirmation(

        // Paramètres de l'email de confirmation d'adresse 
        string $verifyEmailRouteName, Utilisateur $user, 
        TemplatedEmail $email): void
    {

        // Envoi du mail de confirmation d'adresse 
        $signatureComponents = $this -> verifyEmailHelper -> generateSignature(

            // Paramètres de l'email de confirmation d'adresse 
            $verifyEmailRouteName,
            (string) $user -> getId(),
            (string) $user -> getUtilisateurMail(),
            ['id' => $user -> getId()]
        );

        // Paramètres de l'email de confirmation d'adresse
        $context = $email -> getContext();
        $context['signedUrl'] = $signatureComponents -> getSignedUrl();
        $context['expiresAtMessageKey'] = $signatureComponents -> getExpirationMessageKey();
        $context['expiresAtMessageData'] = $signatureComponents -> getExpirationMessageData();

        
        $email -> context($context);

        $this -> mailer -> send($email);
    }

    /**
     * @throws VerifyEmailExceptionInterface
     */
    public function handleEmailConfirmation(Request $request, Utilisateur $user): void
    {
        // Confirmation de l'adresse mail de l'utilisateur 
        $this -> verifyEmailHelper -> validateEmailConfirmationFromRequest(
            $request, (string) $user -> getId(), 
            (string) $user -> getUtilisateurMail()
        );

        
        $user -> setVerified(true);

        $this -> entityManager -> persist($user);
        $this -> entityManager -> flush();
    }
}
