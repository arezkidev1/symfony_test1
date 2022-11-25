<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogueController extends AbstractController

{
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(CategorieRepository $categorieRepository): Response
    {
        
        return $this->render('catalogue/categorie.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }


    #[Route('/souscategorie', name: 'app_souscategorie')]
    public function souscategorie(CategorieRepository $categorieRepository): Response
    {
        return $this->render('catalogue/souscategorie.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    #[Route('/produit', name: 'app_produit')]
    public function produit(ProduitRepository $produitRepository): Response
    {
        return $this->render('catalogue/produit.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

















}
