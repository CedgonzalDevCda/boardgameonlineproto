<?php

namespace App\Form;

use App\Entity\Survey;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameSurvey', TextType::class, [
                    'label' => 'Saisir le nom du questionnaire',
                    'label_attr' => [
                        'class' => 'mt-3'
                    ],
                ]
            )
            ->add('question1', TextType::class, [
                'label' => 'Saisir la question 1',
                'label_attr' => [
                    'class' => 'mt-3'
                ],
            ])
            ->add('question2', TextType::class, [
                'label' => 'Saisir la question 2',
                'label_attr' => [
                    'class' => 'mt-3'
                ],
            ])
            ->add('question3', TextType::class, [
                'label' => 'Saisir la question 3',
                'label_attr' => [
                    'class' => 'mt-3'
                ],
            ])
            ->add('question4', TextType::class, [
                'label' => 'Saisir la question 4',
                'label_attr' => [
                    'class' => 'mt-3'
                ],
            ])
            ->add('question5', TextType::class, [
                'label' => 'Saisir la question 5',
                'label_attr' => [
                    'class' => 'mt-3'
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Survey::class,
        ]);
    }
}
