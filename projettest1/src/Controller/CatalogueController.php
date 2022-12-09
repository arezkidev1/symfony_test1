<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Categorie;
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


    #[Route('/souscategorie/{categorie}', name: 'app_souscategorie')]
    public function souscategorie(Categorie $categorie): Response
    {
        return $this->render('catalogue/souscategorie.html.twig', [
            'categories' => $categorie->getCategories()
        ]);
    }

    #[Route('/souscategorie', name: 'app_souscat')]
    public function souscat(CategorieRepository $repo ): Response
    {
        return $this->render('catalogue/souscategorie.html.twig', [
            'categories' => $repo->findBy([
                "parentCategorie" => !null
            ])
        ]);
    }
    


    #[Route('/produit/{categorie}', name: 'app_produit')]
    public function produit(Categorie $categorie): Response
    {
        return $this->render('catalogue/produit.html.twig', [
            'produits' => $categorie->getProduits(),
        ]);
    }

    #[Route('/produitDetail/{produit}', name: 'app_produitDetail')]
    public function produitDetails(Produit $produit): Response
    {
        return $this->render('catalogue/produitDetail.html.twig', [
            'produit' => $produit
        ]);
    }
















}
