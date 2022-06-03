<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Game;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                    'label' => 'Saisir le nom du jeu',
                ]
            )
            ->add('isVisible',)
            ->add('category', EntityType::class, [
                'label' => 'Sélectionner la catégorie du jeu',
                'required' => false,
                'class' => Category::class,
                'expanded' => true,
                'multiple' => false,
                'placeholder' => 'Aucune catégorie'
            ])
            ->add('rules', TextareaType::class, [
                'label' => 'Ecrivez les règles du jeu',
                'label_attr' => [
                    'class' => 'mt-4'
                ]
            ])
            ->add('ruleVersion', TextType::class, [
                'label' => 'Version du jeu'
            ])
            ->add('minPlayer', NumberType::class, [
                'label' => 'Nombre de joueurs minimum',
                'label_attr' => [
                    'class' => 'mt-4'
                ],

            ])
            ->add('maxPlayer', NumberType::class, [
                'label' => 'Nombre de joueurs maximum',
                'label_attr' => [
                    'class' => 'mt-4'
                ]
            ])
            ->add('age', NumberType::class, [
                'label' => 'Age min recommandé',
                'label_attr' => [
                    'class' => 'mt-4'
                ]
            ])
//            ->add('image')
            ->add('imageFile', VichImageType::class,[
                    'label' => 'Image du jeu',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ]
                ]
            )
            ->add('description', TextareaType::class, [
                'label' => 'Description du jeu',
                'label_attr' => [
                    'class' => 'mt-4'
                ]
            ])
            ->add('onlineVersion')
            ->add('favoris')
            ->add('dateCreation', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('dateLastUpdate', DateType::class, [
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
