<?php

namespace App\Form;

use App\Entity\Friend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FriendType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom et/ou Prénom de votre ami(e)',
                'attr' => [
                    'class' => 'mb-4'
                ],
            ])
            ->add('email', EmailType::class,[
                'label' => 'E-mail',
                'attr' => [
                    'class' => 'mb-4'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Friend::class,
        ]);
    }
}
