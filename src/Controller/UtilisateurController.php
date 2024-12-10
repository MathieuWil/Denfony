<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'utilisateur')]
    public function index(UserInterface $utilisateur): Response
    {
        if (!$utilisateur instanceof Utilisateur) {
            throw $this->createAccessDeniedException('Utilisateur non reconnu.');
        }

        return $this->render('utilisateur/index.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }


    #[Route('/utilisateur/update', name: 'utilisateur_update', methods: ['POST'])]
    public function update(Request $request, EntityManagerInterface $em, UserInterface $utilisateur): Response
{
    if (!$utilisateur instanceof Utilisateur) {
        throw $this->createAccessDeniedException('Utilisateur non reconnu.');
    }

    $utilisateur->setPrenom($request->request->get('prenom'));
    $utilisateur->setNom($request->request->get('nom'));
    $utilisateur->setEmail($request->request->get('email'));
    $utilisateur->setTel($request->request->get('tel'));

    $em->persist($utilisateur);
    $em->flush();

    $this->addFlash('success', 'Profil mis à jour avec succès.');

    return $this->redirectToRoute('utilisateur');
}

    #[Route('/utilisateur/delete', name: 'utilisateur_delete', methods: ['POST'])]
    public function delete(EntityManagerInterface $em): Response
    {
        $utilisateur = $this->getUser();  // Utilisateur connecté

        // Suppression
        $em->remove($utilisateur);
        $em->flush();

        $this->addFlash('warning', 'Compte supprimé.');
        return $this->redirectToRoute('app_logout');
    }
}

