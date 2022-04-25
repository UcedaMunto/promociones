<?php

namespace App\Form;

use App\Entity\ZonaGrua;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZonaGruaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('precio')
            ->add('costo')
            ->add('zip')
            ->add('direccion')
            ->add('ciudad')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ZonaGrua::class,
        ]);
    }
}
