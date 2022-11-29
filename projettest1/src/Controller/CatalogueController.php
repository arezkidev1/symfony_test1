<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use App\Entity\Categorie;
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


    #[Route('/souscategorie/{categorie}', name: 'app_souscategorie')]
    public function souscategorie(Categorie $categorie): Response
    {
        return $this->render('catalogue/souscategorie.html.twig', [
            'categories' => $categorie->getCategories()
        ]);
    }

    #[Route('/produit/{categorie}', name: 'app_produit')]
    public function produit(Categorie $categorie): Response
    {
        return $this->render('catalogue/produit.html.twig', [
            'produits' => $categorie->getProduits(),
        ]);
    }

















}
