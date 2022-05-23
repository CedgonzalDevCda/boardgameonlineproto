<?php

namespace App\Form;

use App\Entity\Gameroom;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbPlayer')
            ->add('dateInvit')
            ->add('hashInvit')
            ->add('hashTimeout')
            ->add('leader')
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
