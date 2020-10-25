<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('firstname', TextType::class,[
                'label'=>"Prénom"
            ])
            ->add('lastname', TextType::class,[

            ])
            ->add('dateofbirth', BirthdayType::class,[
                'label'=>"Date de naissance",

                'widget' => 'single_text',

            ])


            ->add('profilPicture', FileType::class, [
                'mapped' => false,
                'required'=>false,
                'label' => "Photo de profil",
                'attr'=>['class'=>"custom-file-input"]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
