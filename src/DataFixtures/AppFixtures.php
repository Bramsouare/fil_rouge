<?php

namespace App\DataFixtures;

use App\Entity\Tva;
use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Entity\Fournisseur;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        ###############################################################################################
        #                                        LES RUBRIQUES                                        #
        ###############################################################################################

        $rubrique1 = new Rubrique();
        $rubrique1->setRubriqueLibelle("Instruments à vent");
        $rubrique1->setRubriqueImage("saxo1.webp");
        $rubrique1->setRubriqueDescription("Rubrique regroupant les instruments à vent tels que saxophones, trompettes et flûtes.");
        $manager->persist($rubrique1);
        

        $rubrique2 = new Rubrique();
        $rubrique2->setRubriqueLibelle("Instruments à cordes");
        $rubrique2->setRubriqueImage("acoustique1.webp");
        $rubrique2->setRubriqueDescription("Rubrique dédiée aux instruments à cordes comme guitares, et violons.");
        $manager->persist($rubrique2);


        $rubrique3 = new Rubrique();
        $rubrique3->setRubriqueLibelle("Instruments de percussion");
        $rubrique3->setRubriqueImage("batterie1.webp");
        $rubrique3->setRubriqueDescription("Rubrique couvrant les instruments de percussion comme batteries et tambours.");
        $manager->persist($rubrique3);


        $rubrique4 = new Rubrique();
        $rubrique4->setRubriqueLibelle("Pianos et claviers");
        $rubrique4->setRubriqueImage("piano1.webp");
        $rubrique4->setRubriqueDescription("Rubrique pour les pianos acoustiques, numériques et autres claviers.");
        $manager->persist($rubrique4);

        ###############################################################################################
        #                                        FOURNISSEUR                                          #
        ###############################################################################################

        $fournisseur1 = new Fournisseur();
        $fournisseur1->setFournisseurSiret("012345678910");
        $fournisseur1->setFournisseurNom("Beat");
        $fournisseur1->setFournisseurTelephone("0123456789");
        $fournisseur1->setFournisseurMail("beat@gmail.com");
        $fournisseur1->setFournisseurConstructeur("1");
        $manager->persist($fournisseur1);

        ###############################################################################################
        #                                              TVA                                            #
        ###############################################################################################

        $tva1 = new Tva();
        $tva1->setTvaTaux(18.6); 
        $manager->persist($tva1);

        ###############################################################################################
        #                                        UTILISATEUR                                          #
        ###############################################################################################

        $utilisateur1 = new Utilisateur();
        $utilisateur1->setUtilisateurPrenom("Ibrahima");
        $utilisateur1->setUtilisateurNom("Souare");
        $utilisateur1->setUtilisateurSiret("");
        $utilisateur1->setUtilisateurMail("souare@gmail.com");
        $utilisateur1->setUtilisateurReference("123456");
        $utilisateur1->setUtilisateurMdp("987654");
        $utilisateur1->setUtilisateurTelephone("0123456789");
        $utilisateur1->setUtilisateurCoef("18.6");

        ###############################################################################################
        #                                        LES PRODUITS                                         #
        ###############################################################################################


        $produit1 = new Produit();
        $produit1->setFournisseur($fournisseur1);
        $produit1->setTva($tva1);
        $produit1->setProduitLibelle("Saxophone alto");
        $produit1->setProduitDescription("Saxophone alto en laiton avec étui et accessoires. Idéal pour débutants.");
        $produit1->setProduitPrixHt("550.00");
        $produit1->setProduitReference("VENT001");
        $produit1->setProduitImage("saxo2.webp");
        $produit1->setProduitActif("1");
        $produit1->setProduitStock("5");
        $produit1->setRubrique($rubrique1);
        $manager->persist($produit1);


        $produit2 = new Produit();
        $produit2->setFournisseur($fournisseur1);
        $produit2->setTva($tva1);
        $produit2->setProduitLibelle("Saxophone ténor");
        $produit2->setProduitDescription("Saxophone ténor en laiton avec une belle finition. Son riche et chaleureux.");
        $produit2->setProduitPrixHt("600.00");
        $produit2->setProduitReference("VENT002");
        $produit2->setProduitImage("saxo2.webp");
        $produit2->setProduitActif("1");
        $produit2->setProduitStock("5");
        $produit2->setRubrique($rubrique1);
        $manager->persist($produit2);


        $produit3 = new Produit();
        $produit3->setFournisseur($fournisseur1);
        $produit3->setTva($tva1);
        $produit3->setProduitLibelle("Guitare acoustique standard");
        $produit3->setProduitDescription("Guitare acoustique en bois massif avec un son riche et clair. Idéale pour les débutants.");
        $produit3->setProduitPrixHt("300.00");
        $produit3->setProduitReference("CORDE001");
        $produit3->setProduitImage("acoustique1.webp");
        $produit3->setProduitActif("1");
        $produit3->setProduitStock("10");
        $produit3->setRubrique($rubrique2);
        $manager->persist($produit3);


        $produit4 = new Produit();
        $produit4->setFournisseur($fournisseur1);
        $produit4->setTva($tva1);
        $produit4->setProduitLibelle("Guitare acoustique haut de gamme");
        $produit4->setProduitDescription("Guitare acoustique haut de gamme en bois de palissandre avec une finition soignée.");
        $produit4->setProduitPrixHt("750.00");
        $produit4->setProduitReference("CORDE002");
        $produit4->setProduitImage("acoustique2.webp");
        $produit4->setProduitActif("1");
        $produit4->setProduitStock("8");
        $produit4->setRubrique($rubrique2);
        $manager->persist($produit4);


        $produit5 = new Produit();
        $produit5->setFournisseur($fournisseur1);
        $produit5->setTva($tva1);
        $produit5->setProduitLibelle("Guitare électrique modèle 1");
        $produit5->setProduitDescription("Guitare électrique modèle 1 avec corps en érable et micros humbucker pour un son puissant.");
        $produit5->setProduitPrixHt("500.00");
        $produit5->setProduitReference("CORDE003");
        $produit5->setProduitImage("guitare_elec1.webp");
        $produit5->setProduitActif("1");
        $produit5->setProduitStock("15");
        $produit5->setRubrique($rubrique2);
        $manager->persist($produit5);


        $produit6 = new Produit();
        $produit6->setFournisseur($fournisseur1);
        $produit6->setTva($tva1);
        $produit6->setProduitLibelle("Guitare électrique modèle 2");
        $produit6->setProduitDescription("Guitare électrique modèle 2 avec micros single-coil et corps en alder pour un son clair et lumineux.");
        $produit6->setProduitPrixHt("550.00");
        $produit6->setProduitReference("CORDE004");
        $produit6->setProduitImage("guitare_elec2.webp");
        $produit6->setProduitActif("1");
        $produit6->setProduitStock("12");
        $produit6->setRubrique($rubrique2);
        $manager->persist($produit6);


        $produit7 = new Produit();
        $produit7->setFournisseur($fournisseur1);
        $produit7->setTva($tva1);
        $produit7->setProduitLibelle("Batterie acoustique standard");
        $produit7->setProduitDescription("Batterie acoustique complète avec 5 pièces, idéale pour les débutants.");
        $produit7->setProduitPrixHt("700.00");
        $produit7->setProduitReference("PERC001");
        $produit7->setProduitImage("batterie1.webp");
        $produit7->setProduitActif("1");
        $produit7->setProduitStock("10");
        $produit7->setRubrique($rubrique3);
        $manager->persist($produit7);


        $produit8 = new Produit();
        $produit8->setFournisseur($fournisseur1);
        $produit8->setTva($tva1);
        $produit8->setProduitLibelle("Batterie acoustique professionnelle");
        $produit8->setProduitDescription("Batterie acoustique professionnelle avec toms et cymbales de haute qualité.");
        $produit8->setProduitPrixHt("1500.00");
        $produit8->setProduitReference("PERC002");
        $produit8->setProduitImage("batterie2.webp");
        $produit8->setProduitActif("1");
        $produit8->setProduitStock("6");
        $produit8->setRubrique($rubrique3);
        $manager->persist($produit8);


        $produit9 = new Produit();
        $produit9->setFournisseur($fournisseur1);
        $produit9->setTva($tva1);
        $produit9->setProduitLibelle("Piano numérique");
        $produit9->setProduitDescription("Piano numérique avec 88 touches et plusieurs sons pré-programmés.");
        $produit9->setProduitPrixHt("800.00");
        $produit9->setProduitReference("PIANO001");
        $produit9->setProduitImage("piano1.webp");
        $produit9->setProduitActif("1");
        $produit9->setProduitStock("4");
        $produit9->setRubrique($rubrique4);
        $manager->persist($produit9);


        $produit10 = new Produit();
        $produit10->setFournisseur($fournisseur1);
        $produit10->setTva($tva1);
        $produit10->setProduitLibelle("Piano acoustique");
        $produit10->setProduitDescription("Piano acoustique à queue avec finition en bois noble pour une sonorité authentique.");
        $produit10->setProduitPrixHt("5000.00");
        $produit10->setProduitReference("PIANO002");
        $produit10->setProduitImage("piano2.webp");
        $produit10->setProduitActif("1");
        $produit10->setProduitStock("2");
        $produit10->setRubrique($rubrique4);
        $manager->persist($produit10);


        $produit11 = new Produit();
        $produit11->setFournisseur($fournisseur1);
        $produit11->setTva($tva1);
        $produit11->setProduitLibelle("Violon acoustique standard");
        $produit11->setProduitDescription("Violon acoustique en bois avec des cordes en acier, idéal pour les débutants.");
        $produit11->setProduitPrixHt("250.00");
        $produit11->setProduitReference("CORDE005");
        $produit11->setProduitImage("violon1.webp");
        $produit11->setProduitActif("1");
        $produit11->setProduitStock("10");
        $produit11->setRubrique($rubrique2);
        $manager->persist($produit11);


        $produit12 = new Produit();
        $produit12->setFournisseur($fournisseur1);
        $produit12->setTva($tva1);
        $produit12->setProduitLibelle("Violon acoustique haut de gamme");
        $produit12->setProduitDescription("Violon acoustique haut de gamme avec une finition en bois de qualité supérieure, sonorité riche et chaleureuse.");
        $produit12->setProduitPrixHt("800.00");
        $produit12->setProduitReference("CORDE006");
        $produit12->setProduitImage("violon2.webp");
        $produit12->setProduitActif("1");
        $produit12->setProduitStock("5");
        $produit12->setRubrique($rubrique2);
        $manager->persist($produit12);

        $manager->flush();

    }
}
