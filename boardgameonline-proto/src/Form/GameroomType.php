<?php

namespace App\Form;

use App\Entity\Friend;
use App\Entity\Game;
use App\Entity\GameListByUser;
use App\Entity\Gameroom;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //
            ->add('games', EntityType::class,[
                'class' => Game::class,
                'label' => 'Choisissez le jeu auquel vous souhaitez jouer',
                ]
            )
            //
            ->add('selectFriend', EntityType::class, [
                'class' => Friend::class,
                'multiple' => true,
                'mapped' => false,
                'choice_label' => 'name',
                'label' => 'Choisissez les amis avec qui vous souhaitez jouer',
            ])
            // Nombre de joueurs
            ->add('nbPlayer', IntegerType::class, [
                        'label' => 'Nombre de joueurs',
                        'label_attr' => [
                            'class' => 'form-label  mt-4'
                        ],
            ])
            //Bouton Submit ->
            ->add('Inviter', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mb-4'
                ],
            ])
//            ->add('dateInvit', DateTimeType::class, [
//                'placeholder' => [
//                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
//                    'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde',
//                ],
//                'date_label' => 'Date de l invitation',
//            ])
//            ->add('hashInvit', TextType::class, [
//                'label' => 'Le hash d invitation',
//                'label_attr' => [
//                    'class' => 'form-label  mt-4'
//                ],
//            ])
//            ->add('hashTimeout',DateTimeType::class, [
//                'date_label' => "Date de validité du hash d'invitation",
//            ])
//            ->add('leader', TextType::class, [
//                'label' => 'Leader'
//            ])

        ;
    }

//    public function friendForm(FormBuilderInterface $builderFriend, array $options):void{
//        $builderFriend
//            ->add('friend', EntityType::class,[
//                'class' => Friend::class,
//                'choice_label' => 'name',
//                'disabled' => true,
//                'placeholder' => 'Sélectionner un ami à inviter'
//
//            ])
//            ;
//    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gameroom::class,
        ]);
    }
}
