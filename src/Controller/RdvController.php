<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RdvRepository;

class RdvController extends AbstractController
{
    #[Route('/rdv/{id}', name: 'app_rdv')]
    public function detailRdv(RdvRepository $rdvRepository, int $id): Response
    {
        $rdv = $rdvRepository->findBy(['id' => $id]);

        return $this->render('rdv/index.html.twig', [
            'controller_name' => 'RdvController',
            'rdv' => $rdv,
        ]);
    }
}
