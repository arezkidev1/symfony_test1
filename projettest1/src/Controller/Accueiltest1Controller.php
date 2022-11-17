<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Accueiltest1Controller extends AbstractController
{
    #[Route('/accueiltest1', name: 'app_accueiltest1')]
    public function index(): Response
    {
        return $this->render('accueiltest1/index.html.twig', [
            'controller_name' => 'Accueiltest1Controller',
        ]);
    }
}
