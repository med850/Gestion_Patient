<?php

namespace App\Form;

use App\Entity\Soins;
use App\Entity\Seances;
use App\Entity\Patients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddSeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeP', EntityType::class,[
                'class'=>Patients::class,
               ])
            ->add('SoinsCode', EntityType::class,[
                'class'=>Soins::class,
               ])

               ->add('Enregistrer', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-outline-success'
                ))
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seances::class,
        ]);
    }
}
