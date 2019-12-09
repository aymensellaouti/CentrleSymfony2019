<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('etat')
//            ->add('createdAt')
//            ->add('modifiedAt')
            ->add('formateur', null, array(
                'attr' => array(
                    'class' => 'select2'
                )
            ))
            ->add('topics', null, array(
                'attr' => array(
                    'class' => 'select2'
                )
            ))
//            ->add('etudiants')
            ->add('Ajouter Formation', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
