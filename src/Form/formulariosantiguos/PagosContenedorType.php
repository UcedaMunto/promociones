<?php

namespace App\Form;

use App\Entity\PagosContenedor;
use Doctrine\Inflector\Rules\Pattern;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Entity\Contenedor;

class PagosContenedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('monto',NumberType::class, array('required'=>true, 'attr'=>array('step'=>'0.1', 'class' => 'numerico form-control', 'pattern'=>'^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)(?:[eE][+-]?[0-9]+)?$')) )
            ->add('descripcion', TextType::class, array('required'=>true, 'attr'=>array('class'=>'form-control') ))
            ->add('validar', checkboxtype::class, array('required'=>false, 'attr'=>array('class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'nada')))
            //->add('fechaSubida')
            //->add('fechaValidacion')
            ->add('contenedor', EntityType::class, array(
                'required'=>false,
                'class'=> Contenedor::class,
                'placeholder' => 'Elejir contenedor',
                'attr'=>array('class'=>'myselect')
            ))
            //->add('usuario')
            ->add('tipoPago')
            ->add('cuentaBancaria')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PagosContenedor::class,
        ]);
    }
}
