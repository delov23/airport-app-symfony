<?php

namespace AppBundle\Form;

use AppBundle\Entity\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Time;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RouteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', VichFileType::class, [
                'data_class' => null,
                'required' => true,
                'allow_delete' => false,
                'download_link' => true,
                'constraints' => [
                    new Image(['maxSize' => '2M', 'maxSizeMessage' => 'The image is too big']),
                    new NotBlank(['message' => 'The field "Image" is required.'])
                ]
            ])
            ->add('flightNumber', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "Flight Number" is required.']),
                    new Regex(['pattern' => '/[A-Z0-9]{5,7}/', 'message' => 'The flight number is not valid'])
                ]
            ])
            ->add('company', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "Company" is required.']),
                    new Length(['max' => 30, 'maxMessage' => 'The company name is too long.'])
                ]
            ])
            ->add('duration', TextType::class, [
                'constraints' => [
                    new Regex(['pattern' => '/\d{1,2}\:\d{1,2}/', 'message' => 'The duration should be in the format HOURS:MINUTES']),
                    new NotBlank(['message' => 'The field "Duration" is required.'])
                ]
            ])
            ->add('fromAirport', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "From Airport" is required.']),
                    new Length(['max' => 40, 'maxMessage' => 'The airport name is too long.'])
                ],
            ])
            ->add('toAirport', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "To Airport" is required.']),
                    new Length(['max' => 40, 'maxMessage' => 'The airport name is too long.'])
                ]
            ])
            ->add('seats', NumberType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The field "Seats" is required.']),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
            'data_class' => Route::class
        ]);
    }
}
