<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Jeu1 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        $c1 = new Categorie();
        $c1->setName("Guitares");
        $manager->persist($c1);

        $c2 = new Categorie();
        $c2->setName("Claviers");
        $manager->persist($c2);


        $c1sc1 = new Categorie();
        $c1sc1->setName("Guitare Acoustique");
        $c1sc1->setParentCategorie($c1);
        $manager->persist($c1sc1);

        $c1sc2 = new Categorie();
        $c1sc2->setName("Guitare Electrique");
        $c1sc2->setParentCategorie($c1);
        $manager->persist($c1sc2);

        $c2sc1 = new Categorie();
        $c2sc1->setName("Clavier Acoustique");
        $c2sc1->setParentCategorie($c1);
        $manager->persist($c2sc1);

        $c2sc2 = new Categorie();
        $c2sc2->setName("Clavier Electrique");
        $c2sc2->setParentCategorie($c1);
        $manager->persist($c2sc2);



        $p1 = new Produit();
        $p1->setName("Guitares");
        $p1->setDescription("jolie guitare");
        $p1->setCategorie($c1sc2);
        $manager->persist($p1);

        $p2 = new Produit();
        $p2->setName("Guitares");
        $p2->setDescription("vieille guitare");
        $p2->setCategorie($c1sc1);
        $manager->persist($p2);

        $p3 = new Produit();
        $p3->setName("Piano");
        $p3->setDescription("joli piano");
        $p3->setCategorie($c2sc1);
        $manager->persist($p3);

        $p4 = new Produit();
        $p4->setName("Clavier");
        $p4->setDescription("joli clavier");
        $p4->setCategorie($c2sc2);
        $manager->persist($p4);














        $manager->flush();
    }
}
