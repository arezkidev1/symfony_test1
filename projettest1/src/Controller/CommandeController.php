<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    #[Route('/commande', name: 'app_commande')]
    public function commande(): Response
    {
        return $this->render('commande/commande.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }

    #[Route('/checkout', name: 'checkout')]
    public function checkout(): Response
    {
        $user = $this->getUser();

        if ($user == null  ){
            return $this->redirectToRoute('app_login');
        }

        return $this->render('commande/commande.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }



}
