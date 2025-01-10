<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Rubrique;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ########################################
        #             LES RUBRIQUES            #
        ########################################

        $rubrique1 = new Rubrique();

        $rubrique1->setRubriqueLibelle("Instruments à vent");
        $rubrique1->setRubriqueImage("saxo1.webp");
        $rubrique1->setRubriqueDescription("Rubrique regroupant les instruments à vent tels que saxophones, trompettes et flûtes.");

        $manager->persist($rubrique1);
        $manager->flush();


        $rubrique2 = new Rubrique();

        $rubrique2->setRubriqueLibelle("Instruments à cordes");
        $rubrique2->setRubriqueImage("acoustique1.webp");
        $rubrique2->setRubriqueDescription("Rubrique dédiée aux instruments à cordes comme guitares, et violons.");

        $manager->persist($rubrique2);
        $manager->flush();


        $rubrique3 = new Rubrique();

        $rubrique3->setRubriqueLibelle("Instruments de percussion");
        $rubrique3->setRubriqueImage("batterie1.webp");
        $rubrique3->setRubriqueDescription("Rubrique couvrant les instruments de percussion comme batteries et tambours.");

        $manager->persist($rubrique3);
        $manager->flush();


        $rubrique4 = new Rubrique();

        $rubrique4->setRubriqueLibelle("Pianos et claviers");
        $rubrique4->setRubriqueImage("piano1.webp");
        $rubrique4->setRubriqueDescription("Rubrique pour les pianos acoustiques, numériques et autres claviers.");

        $manager->persist($rubrique4);
        $manager->flush();

        ###############################################################################################
        #                                        LES PRODUITS                                       #
        ###############################################################################################

        $produit1 = new Produit();

        $produit1->setProduitLibelle("");
        $produit1->setProduitDescription("");
        $produit1->setProduitPrixHt("");
        $produit1->setProduitReference("");
        $produit1->setProduitImage("");
        $produit1->setProduitActif("");
        $produit1->setProduitStock("");

        $manager->persist($produit1);
        $manager->flush();


        $produit2 = new Produit();

        $produit2->setProduitLibelle("");
        $produit2->setProduitDescription("");
        $produit2->setProduitPrixHt("");
        $produit2->setProduitReference("");
        $produit2->setProduitImage("");
        $produit2->setProduitActif("");
        $produit2->setProduitStock("");

        $manager->persist($produit2);
        $manager->flush();


        $produit3 = new Produit();

        $produit3->setProduitLibelle("");
        $produit3->setProduitDescription("");
        $produit3->setProduitPrixHt("");
        $produit3->setProduitReference("");
        $produit3->setProduitImage("");
        $produit3->setProduitActif("");
        $produit3->setProduitStock("");

        $manager->persist($produit3);
        $manager->flush();


        $produit4 = new Produit();

        $produit4->setProduitLibelle("");
        $produit4->setProduitDescription("");
        $produit4->setProduitPrixHt("");
        $produit4->setProduitReference("");
        $produit4->setProduitImage("");
        $produit4->setProduitActif("");
        $produit4->setProduitStock("");

        $manager->persist($produit4);
        $manager->flush();


        $produit5 = new Produit();

        $produit5->setProduitLibelle("");
        $produit5->setProduitDescription("");
        $produit5->setProduitPrixHt("");
        $produit5->setProduitReference("");
        $produit5->setProduitImage("");
        $produit5->setProduitActif("");
        $produit5->setProduitStock("");

        $manager->persist($produit5);
        $manager->flush();


        $produit6 = new Produit();

        $produit6->setProduitLibelle("");
        $produit6->setProduitDescription("");
        $produit6->setProduitPrixHt("");
        $produit6->setProduitReference("");
        $produit6->setProduitImage("");
        $produit6->setProduitActif("");
        $produit6->setProduitStock("");

        $manager->persist($produit6);
        $manager->flush();


        $produit7 = new Produit();

        $produit7->setProduitLibelle("");
        $produit7->setProduitDescription("");
        $produit7->setProduitPrixHt("");
        $produit7->setProduitReference("");
        $produit7->setProduitImage("");
        $produit7->setProduitActif("");
        $produit7->setProduitStock("");

        $manager->persist($produit7);
        $manager->flush();


        $produit8 = new Produit();

        $produit8->setProduitLibelle("");
        $produit8->setProduitDescription("");
        $produit8->setProduitPrixHt("");
        $produit8->setProduitReference("");
        $produit8->setProduitImage("");
        $produit8->setProduitActif("");
        $produit8->setProduitStock("");

        $manager->persist($produit8);
        $manager->flush();


        $produit9 = new Produit();

        $produit9->setProduitLibelle("");
        $produit9->setProduitDescription("");
        $produit9->setProduitPrixHt("");
        $produit9->setProduitReference("");
        $produit9->setProduitImage("");
        $produit9->setProduitActif("");
        $produit9->setProduitStock("");

        $manager->persist($produit9);
        $manager->flush();


        $produit10 = new Produit();

        $produit10->setProduitLibelle("");
        $produit10->setProduitDescription("");
        $produit10->setProduitPrixHt("");
        $produit10->setProduitReference("");
        $produit10->setProduitImage("");
        $produit10->setProduitActif("");
        $produit10->setProduitStock("");

        $manager->persist($produit10);-
        $manager->flush();


        $produit11 = new Produit();

        $produit11->setProduitLibelle("");
        $produit11->setProduitDescription("");
        $produit10->setProduitPrixHt("");
        $produit10->setProduitReference("");
        $produit10->setProduitImage("");
        $produit10->setProduitActif("");
        $produit10->setProduitStock("");

        $manager->persist($produit10);
        $manager->flush();


        $produit1 = new Produit();

        $produit1->setProduitLibelle("");
        $produit1->setProduitDescription("");
        $produit1->setProduitPrixHt("");
        $produit1->setProduitReference("");
        $produit1->setProduitImage("");
        $produit1->setProduitActif("");
        $produit1->setProduitStock("");
        
        $manager->persist($produit1);
        $manager->flush();



    }
}
// CREATE TABLE produit (
//     tva_id, produit_libelle, produit_description, produit_prix_ht, 
//     produit_reference, produit_image, produit_actif, produit_stock
// ) INSERT INTO
// (1, 1, 1, 'Saxophone alto', 'Saxophone alto en laiton avec étui et accessoires. Idéal pour débutants.', 550.00, 'VENT001', 'saxo1.webp', 1, 5),
// (1, 1, 1, 'Saxophone ténor', 'Saxophone ténor en laiton avec une belle finition. Son riche et chaleureux.', 600.00, 'VENT002', 'saxo2.webp', 1, 5),
// (1, 2, 2, 'Guitare acoustique standard', 'Guitare acoustique en bois massif avec un son riche et clair. Idéale pour les débutants.', 300.00, 'CORDE001', 'acoustique1.webp', 1, 10),
// (1, 2, 2, 'Guitare acoustique haut de gamme', 'Guitare acoustique haut de gamme en bois de palissandre avec une finition soignée.', 750.00, 'CORDE002', 'acoustique2.webp', 1, 8),
// (1, 2, 2, 'Guitare électrique modèle 1', 'Guitare électrique modèle 1 avec corps en érable et micros humbucker pour un son puissant.', 500.00, 'CORDE003', 'guitare_elec1.webp', 1, 15),
// (1, 2, 2, 'Guitare électrique modèle 2', 'Guitare électrique modèle 2 avec micros single-coil et corps en alder pour un son clair et lumineux.', 550.00, 'CORDE004', 'guitare_elec2.webp', 1, 12),
// (1, 3, 3, 'Batterie acoustique standard', 'Batterie acoustique complète avec 5 pièces, idéale pour les débutants.', 700.00, 'PERC001', 'batterie1.webp', 1, 10),
// (1, 3, 3, 'Batterie acoustique professionnelle', 'Batterie acoustique professionnelle avec toms et cymbales de haute qualité.', 1500.00, 'PERC002', 'batterie2.webp', 1, 6),
// (1, 4, 4, 'Piano numérique', 'Piano numérique avec 88 touches et plusieurs sons pré-programmés.', 800.00, 'PIANO001', 'piano1.webp', 1, 4),
// (1, 4, 4, 'Piano acoustique', 'Piano acoustique à queue avec finition en bois noble pour une sonorité authentique.', 5000.00, 'PIANO002', 'piano2.webp', 1, 2),
// (1, 5, 5, 'Violon acoustique standard', 'Violon acoustique en bois avec des cordes en acier, idéal pour les débutants.', 250.00, 'CORDE005', 'violon1.webp', 1, 10),
// (1, 5, 5, 'Violon acoustique haut de gamme', 'Violon acoustique haut de gamme avec une finition en bois de qualité supérieure, sonorité riche et chaleureuse.', 800.00, 'CORDE006', 'violon2.webp', 1, 5);