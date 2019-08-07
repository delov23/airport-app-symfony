<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                    new NotBlank()
                ]
            ])
            ->add('fullName', TextType::class, [
                'constraints' => [
                    new Regex('/^[A-Z][a-z]+\s[A-Z][a-z]+$/'),
                    new Length(['min' => 5, 'max' => 35]),
                    new NotBlank()
                ]
            ])
            ->add('title', TextType::class, [
                'constraints' => [
                    new Length(['min' => 2, 'max' => 10]),
                    new NotBlank()
                ]
            ])
            ->add('image', VichFileType::class, [
                'data_class' => null,
                'required' => true,
                'allow_delete' => false,
                'download_link' => true,
                'constraints' => [
                    new Image(['maxSize' => '2M']),
                    new NotBlank()
                ]
            ])
            ->add('password', RepeatedType::class, [
                'invalid_message' => 'Passwords should match',
                'type' => PasswordType::class,
                'constraints' => [
                    new Length(['min' => 5, 'max' => 80]),
                    new NotBlank()
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
