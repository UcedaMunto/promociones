<?php

namespace App\Form;

use App\Entity\Proveedor;
use App\Entity\States;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $respuestas = $options['proveedor'];
        if($respuestas ==0){
            $builder
            ->add('nombre', TextareaType::class,  array(
                'required' => true, 
                'label'=>'Nombre proveedor:',
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"Nombre completo del proveedor",
                'maxlength' => 100))
            )
            ->add('codigo', NumberType::class, array(
                'required'=>false,
                'label'=>'Codigo del proveedor:',
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"codigo", 'maxlength' => 15
            )))
            ->add('telefono', NumberType::class, array(
                'required' => true, 
                'label'=>'Telefono:',
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"numero telefonico", 'maxlength' => 15)
            ))
            ->add('direccion', TextareaType::class,  array(
                'required' => true, 
                'label'=>'Direccion:',
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"direccion",
                'maxlength' => 250))
            )
            ->add('states', EntityType::class, array(
                'required' => true,
                'label'=>'Estado  :',
                'class' => States::class,
                'placeholder' =>'Selecciona un estado',
                'attr'=> array('class' => 'myselect'),
            ))



        ;

        }else{
            $builder
            ->add('nombre', TextareaType::class,  array(
                'required' => true, 
                'label'=>'Nombre proveedor:',
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"Nombre completo del proveedor",
                'maxlength' => 100)))
            ->add('codigo', NumberType::class, array(
                'required'=>false,
                'label'=>'Codigo del proveedor:',
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"codigo", 'maxlength' => 15
            )))                
            ->add('telefono', NumberType::class, array(
                'required' => true, 
                'label'=>'Telefono:',
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"numero telefonico", 'maxlength' => 15)
            ))
            ->add('direccion', TextareaType::class,  array(
                'required' => true, 
                'label'=>'Direccion:',
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"direccion",
                'maxlength' => 250)))
            ->add('states', EntityType::class, array(
                'required' => true,
                'label'=>'Estado  :',
                'class' => States::class,
                'placeholder' =>'Selecciona un estado',
                'attr'=> array('class' => 'myselect'),
            ))

            ->add('estado', CheckboxType::class, array(
                'required'=>false,
                'label'=>'esta activo?:',
                'attr'=>array('class'=>"form-control" ,)
            ))

        ;

        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
            'proveedor' => 0,
        ]);
    }
}
