<?php

namespace AppBundle\Form;

use AppBundle\Entity\Flight;
use AppBundle\Entity\Progress;
use AppBundle\Service\Progress\ProgressServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
                    new NotBlank()
                ]
            ])
            ->add('price', NumberType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "Price" is required'])
                ],
            ])
            ->add('terminal', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "Terminal" is required']),
                    new Length(['max' => 30, 'maxMessage' => 'The terminal name is too long.'])
                ]
            ])
            ->add('progress', ChoiceType::class, [
                'choices' => $this->progressService->getAll(),
                'choice_label' => function (Progress $progress, $key, $value) {
                    return $progress->getEvent();
                },
                'constraints' => [
                    new NotBlank(['message' => 'The field "Progress" is required']),
                ]
            ])
            ->add('checkIn', DateTimeType::class, [
                'invalid_message' => 'Not a valid date.',
                'html5' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(['message' => 'The field "Check-in time" is required']),
                ]
            ])
            ->add('gate', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "Gate" is required']),
                    new Length(['max' => 30, 'maxMessage' => 'The gate name is too long.'])
                ]
            ])
            ->add('bagsCheckIn', DateTimeType::class, [
                'invalid_message' => 'Not a valid date.',
                'html5' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(['message' => 'The field "Luggage Check-in time" is required']),
                ]
            ])
            ->add('progressTime', TimeType::class, [
                'invalid_message' => 'Not a valid time.',
                'html5' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(['message' => 'The field "Progress Time" is required']),
                ]
            ])
            ->add('seatsTaken', NumberType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "Seats Taken" is required']),
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
