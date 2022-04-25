<?php

namespace App\Form;

use App\Entity\Activo;
use App\Entity\Departamentos;
use App\Entity\EstadoActivo;
use App\Entity\TipoActivo;
use App\Entity\UsuarioEmpleado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Activo1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('codigoBarra',TextType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Código del la biñeta")) 
        )
        ->add('descripcion',TextareaType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Código del la biñeta"))
        )
        ->add('costo', 
            MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Costo"))
        )
        ->add('tipo', EntityType::class, array('class' => TipoActivo::class, 
            'placeholder' => 'Escojer Tipo de Activo', 
            'required' => true, 'attr'=> array('class' => 'myselect'))
        )
        ->add('estado', EntityType::class,  array(
            'required' => false,
            'class' =>  EstadoActivo::class,
            'placeholder' => 'Estado?',
            'attr'=> array('class' => 'form-control'),
        ))
        ->add('departamento', EntityType::class,  array(
                'required' => false,
                'class' => Departamentos::class,
                'placeholder' => 'Departamento respondable del activo?',
                'attr'=> array('class' => 'form-control')
            )
        )
        ->add('responsable')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activo::class,
        ]);
    }
}
