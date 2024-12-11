<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RdvRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Rdv;

class RdvController extends AbstractController
{
    #[Route('/rdv/{id}', name: 'app_rdv')]
    public function detailRdv(RdvRepository $rdvRepository, UtilisateurRepository $utilisateurRepository, int $id): Response
    {
        $rdv = $rdvRepository->findBy(['id' => $id]);
        $ordonnances = reset($rdv)->getOrdonnances();
        $patient = $utilisateurRepository->findBy(['id' => reset($rdv)->getIdPatient()]);
        $medecin = $utilisateurRepository->findBy(['id' => reset($rdv)->getIdMedecin()]);
        $user = $this->getUser();

        return $this->render('rdv/index.html.twig', [
            'controller_name' => 'RdvController',
            'rdv' => reset($rdv),
            'ordonnances' => $ordonnances,
            'patient' => reset($patient),
            'medecin' => reset($medecin),
            'user' => $user,
        ]);
    }

    
    #[Route('/rdv/{id}/annuler', name: 'app_annulerRdv')]
    public function annulerRdv(RdvRepository $rdvRepository, EntityManagerInterface $em, Rdv $rdv): Response
    {
/*       $rdv->setStatut("annuler");

      $em->persist($rdv);
      $em->flush();

      $this->addFlash('success', 'Le RDV à été annulé'); */

      return $this->redirectToRoute('app_accueil');
    }

    #[Route('/rdv/{id}/prendreRdv', name: 'app_prendreRdv')]
    public function prendreRdv(RdvRepository $rdvRepository, EntityManagerInterface $em, Rdv $rdv): Response
    {
/*       $rdv->setStatut("annuler");

      $em->persist($rdv);
      $em->flush();

      $this->addFlash('success', 'Le RDV à été annulé'); */

      return $this->redirectToRoute('app_accueil');
    }
}
