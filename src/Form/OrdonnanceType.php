<?php

namespace App\Form;

use App\Entity\Ordonnance;
use App\Entity\Rdv;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdonnanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_delivree', null, [
                'widget' => 'single_text',
            ])
            ->add('medicament')
            ->add('description')
            ->add('id_rdv', EntityType::class, [
                'class' => Rdv::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ordonnance::class,
        ]);
    }
}
