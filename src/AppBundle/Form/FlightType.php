<?php

namespace AppBundle\Form;

use AppBundle\Entity\Flight;
use AppBundle\Entity\Route;
use AppBundle\Service\Flight\FlightServiceInterface;
use AppBundle\Service\Route\RouteServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;

class FlightType extends AbstractType
{
    private $routeService;


    public function __construct(RouteServiceInterface $routeService)
    {
        $this->routeService = $routeService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('route', ChoiceType::class, [
                'choices' => $this->routeService->getAll(),
                'choice_label' => function(Route $route, $key, $value) {
                    return strtoupper($route->getFlightNumber());
                },
                'constraints' => [
                    new NotBlank(),
                ]
            ])
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
            'data_class' => Flight::class
        ]);
    }
}
