<?php

namespace AppBundle\Form;

use AppBundle\Entity\Flight;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FlightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('route', ChoiceType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('date', DateType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('price', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('terminal', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
            'data_class' => Flight::class
        ]);
    }
}