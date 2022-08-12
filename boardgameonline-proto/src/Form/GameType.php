<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Game;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
                'label_attr' => [
                    'class' => 'fs-4'
                ],
                'required' => false,
                'class' => Category::class,
                'expanded' => true,
                'multiple' => false,
                'placeholder' => 'Aucune catégorie'
            ])
            ->add('rules', CKEditorType::class, [
                'label' => 'Ecrivez les règles du jeu',
            ])
            ->add('ruleVersion', TextType::class, [
                'label' => 'Version - Règle du jeu'
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
            ->add('minPlayingTime', NumberType::class, [
                'label' => 'Temps mini (en mn)',
                'label_attr' => [
                    'class' => 'mt-4'
                ],

            ])
            ->add('maxPlayingTime', NumberType::class, [
                'label' => 'Temps maxi (en mn)',
                'label_attr' => [
                    'class' => 'mt-4'
                ]
            ])
            ->add('age', NumberType::class, [
                'label' => 'Age min requis pour jouer',
                'label_attr' => [
                    'class' => 'fs-4'
                ]
            ])
//            ->add('image')
            ->add('imageFile', VichImageType::class,[
                    'delete_label' => "Supprimer l'image",
                    'download_label' => "Télécharger l'image",
                    'download_uri' => true,
                    'label' => 'Image du jeu',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'required' => false,
                ]
            )
            ->add('description', CKEditorType::class, [
                'label' => 'Pitch du jeu',
                'label_attr' => [
                    'class' => 'fs-4'
                ],
            ])
            ->add('onlineVersion', TextType::class, [
                'label' => 'Version du jeu en ligne'
            ])
//            ->add('favoris')
            ->add('dateCreation', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de création du jeu',
            ])
            ->add('dateLastUpdate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de dernière mise à jour du jeu',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
