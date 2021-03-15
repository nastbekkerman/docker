<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Otel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OtelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('stars')
            ->add('city',EntityType ::class,[
                'class' => 'App\Entity\City',
                'label' => 'город'
            ])
            ->add('address',TextType ::class,[
                'label' => 'Адрес (Улица, дом)'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Otel::class,
        ]);
    }
}
