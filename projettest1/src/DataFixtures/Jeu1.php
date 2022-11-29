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
        $c2sc1->setParentCategorie($c2);
        $manager->persist($c2sc1);

        $c2sc2 = new Categorie();
        $c2sc2->setName("Clavier Electrique");
        $c2sc2->setParentCategorie($c2);
        $manager->persist($c2sc2);




        for ($i = 0; $i < 20; $i++) {
            $produit = new Produit();
            $produit->setName("Guitares" . $i)
                ->setDescription("jolie guitare")
                ->setPrix(mt_rand(10, 250))
                ->setCategorie($c1sc2);
            $manager->persist($produit);
        }




        $p1 = new Produit();
        $p1->setName("Guitares");
        $p1->setDescription("jolie guitare");
        $p1->setPrix(111);
        $p1->setCategorie($c1sc2);
        $manager->persist($p1);


        $p2 = new Produit();
        $p2->setName("Guitares");
        $p2->setDescription("vieille guitare");
        $p2->setPrix(222);
        $p2->setCategorie($c1sc1);
        $manager->persist($p2);

        for ($i = 0; $i < 20; $i++) {
            $produit = new Produit();
            $produit->setName("Guitares" . $i)
                ->setDescription("vieille guitare")
                ->setPrix(mt_rand(10, 250))
                ->setCategorie($c1sc1);
            $manager->persist($produit);
        }


        $p3 = new Produit();
        $p3->setName("Piano");
        $p3->setDescription("joli piano");
        $p3->setPrix(333);
        $p3->setCategorie($c2sc1);
        $manager->persist($p3);

        for ($i = 0; $i < 20; $i++) {
            $produit = new Produit();
            $produit->setName("Guitares" . $i)
                ->setDescription("joli piano")
                ->setPrix(mt_rand(10, 250))
                ->setCategorie($c2sc1);
            $manager->persist($produit);
        }


        $p4 = new Produit();
        $p4->setName("Clavier");
        $p4->setDescription("joli clavier");
        $p4->setPrix(444);
        $p4->setCategorie($c2sc2);
        $manager->persist($p4);

        for ($i = 0; $i < 20; $i++) {
            $produit = new Produit();
            $produit->setName("Guitares" . $i)
                ->setDescription("joli clavier")
                ->setPrix(mt_rand(10, 250))
                ->setCategorie($c2sc2);
            $manager->persist($produit);
        }















        $manager->flush();
    }
}