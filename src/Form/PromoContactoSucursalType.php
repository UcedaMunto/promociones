<?php

namespace App\Form;

use App\Entity\PromoContactoSucursal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PromoSucursal;
class PromoContactoSucursalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('sucursal', EntityType::class,  array(
                'required' => true,
                'class' => PromoSucursal::class,
                'placeholder' => 'tipo?',
                'attr'=> array('class' => 'myselect','disabled'=>true),
            ))
            ->add('idContacto',  ContactoType::class, array('label'=>'Datos de contacto'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PromoContactoSucursal::class,
        ]);
    }
}
