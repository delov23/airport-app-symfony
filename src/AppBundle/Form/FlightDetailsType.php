<?php

namespace AppBundle\Form;

use AppBundle\Entity\Flight;
use AppBundle\Entity\Progress;
use AppBundle\Entity\Route;
use AppBundle\Service\Progress\ProgressServiceInterface;
use AppBundle\Service\Route\RouteServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class FlightDetailsType extends AbstractType
{
    private $progressService;


    public function __construct(ProgressServiceInterface $progressService)
    {
        $this->progressService = $progressService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'invalid_message' => 'Not a valid date.',
                'html5' => true,
                'widget' => 'single_text',
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
            ])
            ->add('progress', ChoiceType::class, [
                'choices' => $this->progressService->getAll(),
                'choice_label' => function(Progress $progress, $key, $value) {
                    return $progress->getEvent();
                },
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('checkIn', DateTimeType::class, [
                'invalid_message' => 'Not a valid date.',
                'html5' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('gate', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('bagsCheckIn', DateTimeType::class, [
                'invalid_message' => 'Not a valid date.',
                'html5' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('progressTime', TimeType::class, [
                'invalid_message' => 'Not a valid date.',
                'html5' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('seatsTaken', NumberType::class, [
                'constraints' => [
                    new NotBlank()
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
