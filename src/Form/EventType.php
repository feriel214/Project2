<?php

namespace App\Form;

use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array(
                'attr'=>array(
                    'class'=>'form-control')
            ))
            ->add('photo',FileType::class, array(
                'data_class' => null,
                'attr'=>array('class' => 'form-control-file')
                ))
            ->add('lieu',TextType::class ,array(
                'attr'=>array(
                    'class'=>'form-control')
                ))
            ->add('descreption',TextareaType::class ,array(
                'attr'=>array(
                    'class'=>'form-control')))
            ->add('date_debut',DateType::class ,array(
                'attr'=>array(
                    'class'=>'input-group date')))
            ->add('date_fin',DateType::class ,array(
                'attr'=>array(
                    'class'=>'input-group date')))
            ->add('temps_debut',TimeType::class ,array(
                'attr'=>array(
                    'class'=>'input-group time')))
            ->add('temps_fin',TimeType::class ,array(
                'attr'=>array(
                    'class'=>'input-group time')))
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
