<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Engine;
use App\Repository\EngineRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    /**
     * @var EngineRepository
     */
    private $engineRepository;

    public function __construct(EngineRepository $engineRepository)
    {
        $this->engineRepository = $engineRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('make')
            ->add('bodyType', ChoiceType::class, [
                'choices'  => [
                    'Touring' => 'touring',
                    'Sedan' => 'sedan',
                    'Coupe' => 'coupe',
                    'Van' => 'van'
                ],
            ])
            ->add('color')
            ->add('year')
            ->add('mileage')
            ->add('fuelType', ChoiceType::class, [
                'choices'  => [
                    'Diesel' => 'diesel',
                    'Petrol' => 'petrol',
                    'LPG' => 'lpg'
                ],
            ])
            ->add('status')
            ->add('price')
            ->add('country')
            ->add('description')
            ->add('engine', EntityType::class, [
                'class' => Engine::class,
                'choice_label' => function(Engine $engine) {
                    return sprintf('(%d) %s', $engine->getId(), $engine->getName());
                },
                'placeholder' => 'Choose an engine',
                'choices' => $this->engineRepository->findAll(),
            ])
            ->add('photo', FileType::class, [
                    'label' => 'Photo',

                    // unmapped means that this field is not associated to any entity property
                    'mapped' => false,

                    // make it optional so you don't have to re-upload the PDF file
                    // every time you edit the Product details
                    'required' => false,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
