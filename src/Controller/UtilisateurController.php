<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'utilisateur')]
    public function index(UserInterface $utilisateur): Response
    {
        if (!$utilisateur instanceof Utilisateur) {
            throw $this->createAccessDeniedException('Utilisateur non reconnu.');
        }

        // Vérifier si l'utilisateur est un médecin en vérifiant les rôles
        $isMedecin = in_array('ROLE_MEDECIN', $utilisateur->getRoles());  // Vérifie si le rôle 'ROLE_MEDECIN' est attribué à l'utilisateur

        // Vérifier si l'utilisateur a un domaine médical
        $hasDomaineMedical = $utilisateur->getIdDomaine() !== null;  // Vérifie si un domaine médical est attribué

        return $this->render('utilisateur/index.html.twig', [
            'utilisateur' => $utilisateur,
            'isMedecin' => $isMedecin,  // Variable pour savoir si l'utilisateur est médecin
            'hasDomaineMedical' => $hasDomaineMedical,  // Variable pour savoir si l'utilisateur a un domaine médical
        ]);
    }

    #[Route('/utilisateur/update', name: 'utilisateur_update', methods: ['POST'])]
    public function update(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, UserInterface $utilisateur): Response
    {
        if (!$utilisateur instanceof Utilisateur) {
            throw $this->createAccessDeniedException('Utilisateur non reconnu.');
        }

        $tel = $request->request->get('tel');
        $adresse = $request->request->get('adresse');
        $plainPassword = $request->request->get('plainPassword');
        $plainPasswordConfirm = $request->request->get('plainPasswordConfirm');

        if ($plainPassword !== $plainPasswordConfirm) {
            $this->addFlash('warning', 'Les mots de passe ne correspondent pas.');
            return $this->redirectToRoute('utilisateur');
        }

        // Mise à jour des informations de l'utilisateur
        $utilisateur->setTel($tel);
        $utilisateur->setAdresse($adresse);

        // Si un nouveau mot de passe est fourni, on le hache et l'on le met à jour
        if (!empty($plainPassword)) {
            $hashedPassword = $passwordHasher->hashPassword($utilisateur, $plainPassword);
            $utilisateur->setPassword($hashedPassword);
        }

        // Sauvegarde des modifications en base de données
        $em->persist($utilisateur);
        $em->flush();

        $this->addFlash('success', 'Profil mis à jour avec succès.');

        return $this->redirectToRoute('utilisateur');
    }

    #[Route('/utilisateur/delete', name: 'utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $em, TokenStorageInterface $tokenStorage, SessionInterface $session): Response
    {
        $utilisateur = $this->getUser();  // Utilisateur connecté

        if (!$utilisateur instanceof Utilisateur) {
            throw $this->createAccessDeniedException('Utilisateur non reconnu.');
        }

        // Suppression de l'utilisateur
        $em->remove($utilisateur);
        $em->flush();

        $this->addFlash('warning', 'Compte supprimé.');

        // Déconnexion explicite de l'utilisateur
        $tokenStorage->setToken(null);  // Vide le token de sécurité
        $session->invalidate();         // Invalide la session de l'utilisateur

        // Rediriger vers la page de déconnexion
        return $this->redirectToRoute('app_logout');
    }
}
