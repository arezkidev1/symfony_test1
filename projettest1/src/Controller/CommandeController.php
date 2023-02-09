<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\DetailsCommande;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DetailsCommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
     #[Route('/commande', name: 'app_commande')]
    public function index(): Response
    {
        if(!$this->getUser()) {
            $this->addFlash("error", "Utilisateur non connecté");
            return $this->redirectToRoute("app_login");
        }
        
    return $this->render('commande/historique.html.twig', [
    'controller_name' => 'CommandeController',
    ]);
    }
   

    private function redirectForm(string $message = "Une erreur est survenue")
    {
        $this->addFlash("error", $message);
        $this->redirectToRoute("app_commande");
    }

    #[Route('/commande_validee', name: 'app_commande_validee', methods: ["POST"])]
    public function commandeValidee(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, ProduitRepository $produitRepository): Response
    {
        if(!$this->getUser()) {
            $this->addFlash("error", "Utilisateur non connecté");
            return $this->redirectToRoute("app_login");
        }

        if (!$request->request) {
            $this->redirectForm("Formulaire Incorrect");
        }

        $name = $request->request->get("name");
        $prenom = $request->request->get("prenom");
        $tel = $request->request->get("tel");
        $adresseLivraison =
            $request->request->get("delivery-number")
            . " "
            . $request->request->get("delivery-street")
            . ", "
            . $request->request->get("delivery-zipcode")
            . ", "
            . $request->request->get("delivery-city")
            . ", "
            . $request->request->get("delivery-country");

        $adresseFacturation =
            $request->request->get("billing-number")
            . " "
            . $request->request->get("billing-street")
            . ", "
            . $request->request->get("billing-zipcode")
            . ", "
            . $request->request->get("billing-city")
            . ", "
            . $request->request->get("billing-country");

        if (
               !$name
            || !$prenom
            || !$tel
            || !$request->request->get("billing-number")
            || !$request->request->get("billing-street")
            || !$request->request->get("billing-zipcode")
            || !$request->request->get("billing-city")
            || !$request->request->get("billing-country")
            || !$request->request->get("delivery-number")
            || !$request->request->get("delivery-street")
            || !$request->request->get("delivery-zipcode")
            || !$request->request->get("delivery-city")
            || !$request->request->get("delivery-country")
        ) {
            $this->redirectForm("Erreur de saisie");
        }

        //dd(gettype($adresseFacturation), $adresseLivraison);

        $panier = $session->get("panier", []);
        $commande = new Commande();

        $commande->setNom($name)
            ->setPrenom($prenom)
            ->setTelephone($tel)
            ->setAdresseLivraison($adresseLivraison)
            ->setAdresseFacturation($adresseFacturation)
            ->setDateCommande(new \DateTime())
            ->setUser($this->getUser());


        foreach ($panier as $detail) {
            $detailsCommande = new DetailsCommande();

            $detailsCommande->setQuantite($detail->quantite);
            $detailsCommande->setCommande($commande);
            $detailsCommande->setProduit($produitRepository->find($detail->getId()));
            
            $entityManager->persist($detailsCommande);

        }
        $entityManager->persist($commande);
        $entityManager->flush();

        $session->set("panier", []);

        $this->addFlash("success", "Votre commande a été validée");
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