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
                    new NotBlank(['message' => 'Please provide an image'])
                ]
            ])
            ->add('flightNumber', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex(['pattern' => '/[A-Z0-9]{5,7}/', 'message' => 'The flight number is not valid'])
                ]
            ])
            ->add('company', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Please, provide a company']),
                    new Regex(['pattern' => '/[A-Z]{2,3}/', 'message' => '...'])
                ]
            ])
            ->add('duration', TextType::class, [
                'constraints' => [
                    new Regex(['pattern' => '/\d{1,2}\:\d{1,2}/', 'message' => 'The duration should be in the format HOURS:MINUTES']),
                    new NotBlank(['message' => 'Please provide a duration'])
                ]
            ])
            ->add('fromAirport', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[A-Z]{2,4}/')
                ],
            ])
            ->add('toAirport', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[A-Z]{2,4}/')
                ]
            ])
            ->add('seats', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
//                    new Count(['min' => 10, 'max' => 200])
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
