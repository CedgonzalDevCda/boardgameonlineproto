<?php

namespace App\Form;

use App\Entity\Survey;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameSurvey')
            ->add('question1')
            ->add('question2')
            ->add('question3')
            ->add('question4')
            ->add('question5')
            ->add('score1')
            ->add('score2')
            ->add('score3')
            ->add('score4')
            ->add('score5')
            ->add('player')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Survey::class,
        ]);
    }
}
