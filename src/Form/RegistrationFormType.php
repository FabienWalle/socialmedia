<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'attr' => [
                    'class' => 'form-control my-2'
                ]])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control my-2'
                ]])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class'=>'form-control my-2'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Votre mot de passe doit comporter au minimum {{limit}} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 180,
                        'maxMessage'=>'Votre mot de passe ne doit pas comporter plus de {{limit}} caractères'
                    ]),
                ],
            ])
            ->add('bio',TextType::class, [
        'attr' => [
            'class' => 'form-control my-2'
        ],
                'required' => false])
            ->add('dob', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control my-2'
                ],
                'required' => false
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
