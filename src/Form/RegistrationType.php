<?php

namespace App\Form;

//use App\Entity\DomaineMedical;
use App\Entity\Utilisateur;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
#            ->add('dateInscription', null, [
#                'widget' => 'single_text'
#            ])
            ->add('adresse')
#            ->add('dateDebut', null, [
#                'widget' => 'single_text'
#            ])
#            ->add('idDomaine', EntityType::class, [
#               'class' => DomaineMedical::class,
#                'choice_label' => 'id',
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
