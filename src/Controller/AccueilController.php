<?php

namespace App\Controller;

use App\Repository\RdvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(RdvRepository $RdvRepository): Response
    {
        // Récupération de tous les rendez-vous
        $rdv = $RdvRepository->findAll();
        
        // Rendu de la vue avec les données du rendez-vous
        return $this->render('accueil/index.html.twig', [
            'rdv' => $rdv,  // On passe la variable 'rdv' à la vue
        ]);
    }
}
