<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isVisible')
            ->add('name')
            ->add('category')
            ->add('rules')
            ->add('ruleVersion')
            ->add('minPlayer')
            ->add('maxPlayer')
            ->add('age')
            ->add('image')
            ->add('description')
            ->add('onlineVersion')
            ->add('favoris')
            ->add('dateCreation')
            ->add('dateLastUpdate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
