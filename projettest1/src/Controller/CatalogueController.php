<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController

{
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(): Response
    {
        return $this->render('catalogue/categorie.html.twig', [
            'controller_name' => 'CatalogueController',
        ]);
    }


    #[Route('/souscategorie', name: 'app_souscategorie')]
    public function souscategorie(): Response
    {
        return $this->render('catalogue/souscategorie.html.twig', [
            'controller_name' => 'CatalogueController',
        ]);
    }

    #[Route('/produit', name: 'app_produit')]
    public function produit(): Response
    {
        return $this->render('catalogue/produit.html.twig', [
            'controller_name' => 'CatalogueController',
        ]);
    }

















}
