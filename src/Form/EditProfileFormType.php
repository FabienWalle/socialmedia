<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr'=>[
                    'class'=>'form-control my-2'
                ],
                'label'=>'Pseudo'
            ])
            ->add('email', EmailType::class, [
                'attr'=>[
                    'class'=>'form-control my-2'
                ],
                'label'=>'Adresse email'
            ])
            ->add('bio', TextType::class, [
                'attr'=>[
                    'class'=>'form-control my-2'
                ],
                'label'=>'Ma bio'
            ])
            ->add('dob', DateType::class, [
                'attr'=>[
                    'class'=>'form-control my-2'
                ],
                'format'=>'dd-MM-yyyy',
                'years' => range(date('Y') - 100, date('Y')),
                'label'=>'Date de naissance'
            ])
            ->add('submit', SubmitType::class, [
                'attr'=>[
                    'class'=>'form-control btn btn-primary my-2'
                ],
                'label'=>'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
