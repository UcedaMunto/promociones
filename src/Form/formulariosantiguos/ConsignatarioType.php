<?php

namespace App\Form;

use App\Entity\Consignatario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsignatarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('direccion')
            ->add('direccion2')
            ->add('email')
            ->add('telefono')
            ->add('encargado')
            ->add('nit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consignatario::class,
        ]);
    }
}
