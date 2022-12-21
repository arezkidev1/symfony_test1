<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{

    
    #[Route('/panier', name: 'app_panier')]
    public function index(SessionInterface $session): Response
    {
        


        return $this->render('panier/index.html.twig', [
            "panier" => $session->get("panier", [])
        ]);
    }

   #[Route('/add_panier/{id}', name: 'app_add_panier')]
    public function addDetail(SessionInterface $session, ProduitRepository $produit_repo,  EntityManagerInterface $entityManager, int $id): Response
    {
        $produit = $produit_repo->find($id);

        $tab = $session->get("panier", []);

        $tab[] = $produit;

        $session->set("panier", $tab);

        // dd($detail);
        // $quantite = $detail->getQuantite();
        // $quant = $detail->setQuantite($quantite + 1);

        // $entityManager->persist($detailPanier);
        // $entityManager->flush($detailPanier);

        return $this->redirect('/panier');
;

    } 

    #[Route('/panier2', name: 'app_panier2')]
    public function panier2(SessionInterface $session): Response
    {
        


        return $this->render('panier/panier2.html.twig', [
            "panier" => $session->get("panier2", [])
        ]);
    }


    #[Route('/add_panier2/{id}', name: 'app_add_panier2')]
    public function addDetail2(SessionInterface $session, ProduitRepository $produit_repo,  EntityManagerInterface $entityManager, int $id): Response
    {
        $produit = $produit_repo->find($id);

        $tab = $session->get("panier2", []);

        $p = null;
        foreach ($tab as $produit) {
            if ($produit->getId()==$id) {
                $p = $produit;
            }
        }
      
        if ($p==null) {
            $p = $produit_repo->find($id);
            $p->quantite = 1;
            $tab[] = $p;
            
        }  
        else {
            $p->quantite++;
        }

        $session->set("panier2", $tab);

        // dd($detail);
        // $quantite = $detail->getQuantite();
        // $quant = $detail->setQuantite($quantite + 1);

        // $entityManager->persist($detailPanier);
        // $entityManager->flush($detailPanier);

        return $this->redirect('/panier2');
;

    } 

    #[Route('/sub/{id}', name: 'app_sub')]
    public function sub(SessionInterface $session, ProduitRepository $repo, $id): Response
    {

        $tab=$session->get("panier2",[]);
        
        $p = null;
        foreach ($tab as $produit) {
            if ($produit->getId()==$id) {
                $p = $produit;
            }
        }

        if ($p==null) {
            $p = $repo->find($id);
            $p->quantite = 1;
            $tab[] = $p;
        }
        else {
            $p->quantite--;
            if($p->quantite <= 0){
                array_pop($tab);
            }
        }



        $session->set("panier2", $tab);

//         dd($tab);

        return $this->redirect("/panier2");

    }

}
