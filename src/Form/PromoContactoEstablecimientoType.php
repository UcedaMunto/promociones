<?php

namespace App\Form;

use App\Entity\PromoContactoEstablecimiento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PromoEstablecimiento;

class PromoContactoEstablecimientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('establecimiento', EntityType::class,  array(
                'required' => true,
                'class' => PromoEstablecimiento::class,
                'placeholder' => 'tipo?',
                'attr'=> array('class' => 'myselect','disabled'=>true),
            ))

            ->add('contacto',  ContactoType::class, array( ) )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PromoContactoEstablecimiento::class,
        ]);
    }
}
