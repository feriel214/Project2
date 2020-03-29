<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password',PasswordType::class,array(
                'attr'=>array(
                    'class'=>"form-control" ,
                    'placeholder'=>"Votre Nom" ,
                    'name'=>"name"

                )
            ))
            ->add('lastLogin')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('name',TextType::class,array(
                'attr'=>array(
                    'class'=>"form-control" ,
                    'name'=>"pass"     

                )
            ))
            ->add('phone')
            ->add('birthdate')
            ->add('adress')
            ->add('photo')
            ->add('descreption')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
