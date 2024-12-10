<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Rdv;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
#            ->add('roles')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('tel')
#            ->add('medecin', EntityType::class, [
#                'class' => Medecin::class,
#'choice_label' => 'id',
#            ])
#            ->add('patient', EntityType::class, [
#                'class' => Patient::class,
#'choice_label' => 'id',
#            ])
#            ->add('rdv', EntityType::class, [
#                'class' => Rdv::class,
#'choice_label' => 'id',
#            ])
#            ->add('rdvMedecin', EntityType::class, [
#                'class' => Rdv::class,
#'choice_label' => 'id',
#            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
