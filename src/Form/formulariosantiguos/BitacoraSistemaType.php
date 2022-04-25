<?php

namespace App\Form;

use App\Entity\BitacoraSistema;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BitacoraSistemaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('usuario')
            ->add('parametros')
            ->add('ruta')
            ->add('descripcion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BitacoraSistema::class,
        ]);
    }
}
