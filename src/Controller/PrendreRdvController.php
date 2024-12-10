<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Rdv;
use App\Form\PrendreRdvType;
use App\Repository\RdvRepository;

class PrendreRdvController extends AbstractController
{
    #[Route('/prendre/rdv', name: 'app_prendre_rdv')]
    public function prendre_rdv(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Rdv
        $rdv = new Rdv();

        // Create the form
        $RdvForm = $this->createForm(PrendreRdvType::class, $rdv);
        
        // Remove fields we dont want displayed
        $RdvForm->remove('statut');
        $RdvForm->remove('idPatient');
        $RdvForm->remove('idMedecin');

        // hard values
        $rdv->setIdPatient($this->getUser());
        $rdv->setStatut("en attente");

        // Handle the form submission
        $RdvForm->handleRequest($request);

        

        if ($RdvForm->isSubmitted() && $RdvForm->isValid()) {
            // Save the user to the database
            $entityManager->persist($rdv);
            $entityManager->flush();

            // Redirect to a success page or login page
            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('prendre_rdv/index.html.twig', [
            'controller_name' => 'PrendreRdvController',
            'form' => $RdvForm->createView(),
        ]);
    }
}