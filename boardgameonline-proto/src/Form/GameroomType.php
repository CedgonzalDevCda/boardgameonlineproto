<?php

namespace App\Form;

use App\Entity\Gameroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbPlayer', TextType::class, [
                        'label' => 'Nombre de joueurs',
                        'label_attr' => [
                            'class' => 'form-label  mt-4'
                        ],
            ])
            ->add('dateInvit', DateTimeType::class, [
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                    'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde',
                ],
                'date_label' => 'Date de l invitation',
            ])
            ->add('hashInvit', TextType::class, [
                'label' => 'Le hash d invitation',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
            ])
            ->add('hashTimeout',DateTimeType::class, [
                'date_label' => "Date de validité du hash d'invitation",
            ])
            ->add('leader', TextType::class, [
                'label' => 'Leader'
            ])
            ->add('games')
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
