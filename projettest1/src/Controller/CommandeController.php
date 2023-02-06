<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\DetailsCommande;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DetailsCommandeRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
   /*  #[Route('/commande', name: 'app_commande')]
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
 */

    private $detailsCommandeRepository;
/* public function __construct(DetailsCommandeRepository $detailsCommandeRepository) {
        $this->detailsCommandeRepository = $detailsCommandeRepository;
} */



    #[Route('/commande', name: 'app_commande')]
    public function commande(): Response
    {
        return $this->render('commande/commande.html.twig', [
        ]);
    }

    #[Route('/commande_validee', name: 'app_commande_validee')]
    public function commandeValidee(SessionInterface $session, EntityManagerInterface $entityManager, ProduitRepository $produitRepository): Response
    {
        //dd($session);
        $panier = $session->get("panier2", []);
        $detailsCommande = New DetailsCommande();
        $commande = new Commande();
      
        foreach ( $panier as $detail ) {
            $detailsCommande->setQuantite($detail->quantite);
            $detailsCommande->setCommande($commande);
            $detailsCommande->setProduit($produitRepository->find($detail->getId()));
            $commande->setDateCommande(new \DateTime());
            $commande->setUser($this->getUser());
        }
        $entityManager->persist($detailsCommande);
        $entityManager->persist($commande);
        $entityManager->flush();

        $session->set("panier2", []);
        
        return $this->redirect("/");
    }

    #[Route('/checkout', name: 'checkout')]
    public function checkout(): Response
    {
        $user = $this->getUser();

        if ($user == null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('commande/commande.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }



}
