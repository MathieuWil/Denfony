<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use App\Repository\UtilisateurRepository;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Create a new user
        $utilisateur = new Utilisateur();

        // Create the form
        $registerForm = $this->createForm(RegistrationType::class, $utilisateur);
        
        $utilisateur->setRoles(['ROLE_PATIENT']);
        $currentDateTime = new \DateTime();
        $utilisateur->setDateInscription($currentDateTime);

        // Handle the form submission
        $registerForm->handleRequest($request);

        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            // Encode the password
            $hashedPassword = $passwordHasher->hashPassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($hashedPassword);

            // Save the user to the database
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            // Redirect to a success page or login page
            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'form' => $registerForm->createView(),
        ]);
    }
}
