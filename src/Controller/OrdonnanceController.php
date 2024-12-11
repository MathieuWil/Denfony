<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Ordonnance;
use App\Form\OrdonnanceType;
use App\Repository\RdvRepository;

class OrdonnanceController extends AbstractController
{
    #[Route('/{id}/ordonnance', name: 'app_creerOrdonnance')]
    public function creerOrdonnance(Request $request, RdvRepository $rdvRepository, EntityManagerInterface $entityManager, int $id): Response
    {
      // Create a new Ordonnance
      $ordonnance = new Ordonnance();

      $rdv = $rdvRepository->findBy(['id' => $id]);
      $rdv = reset($rdv);

      // Create the form
      $OrdonnanceForm = $this->createForm(OrdonnanceType::class, $ordonnance);
      
      // Remove fields we dont want displayed
      $OrdonnanceForm->remove('date_delivree');
      $OrdonnanceForm->remove('id_rdv');

      $currentDateTime = new \DateTime();
      // hard values
      $ordonnance->setIdRdv($rdv);
      $ordonnance->setDateDelivree($currentDateTime);

      // Handle the form submission
      $OrdonnanceForm->handleRequest($request);

      

      if ($OrdonnanceForm->isSubmitted() && $OrdonnanceForm->isValid()) {
          // Save the user to the database
          $entityManager->persist($ordonnance);
          $entityManager->flush();

          // Redirect to a success page or login page
          return $this->redirectToRoute('app_accueil');
      }

      return $this->render('ordonnance/index.html.twig', [
        'idRdv' => $id,
        'form' => $OrdonnanceForm->createView(),
      ]);
    }
}