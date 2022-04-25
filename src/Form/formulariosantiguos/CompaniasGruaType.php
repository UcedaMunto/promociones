<?php

namespace App\Form;

use App\Entity\CompaniasGrua;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompaniasGruaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $bandera=$options['bandera'];
        if($bandera == 'nuevo'){
            $builder
            ->add('nombre', TextType::class, array('required' => true,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre")))
            ->add('direccion', TextareaType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Dirección")))
            ->add('telefono', TextType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"teléfono")))
            ->add('numMiembro', TextType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"numMiembro")))
            ->add('telefono2', TextType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"telefono2")))
            ->add('nombreContacto', TextType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre de contácto")))
            ->add('email', EmailType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"E-mail de contacto")))
            ;
        }
        if($bandera == 'editar'){
            $builder
            ->add('direccion', TextareaType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Dirección")))
            ->add('telefono', TextType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"teléfono")))
            ->add('numMiembro', TextType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"numMiembro")))
            ->add('telefono2', TextType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"telefono2")))
            ->add('nombreContacto', TextType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre de contácto")))
            ->add('email', EmailType::class, array('required' => false,
                'attr'=>array('class'=>"form-control", 'placeholder'=>"E-mail de contacto")))
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CompaniasGrua::class,
            'bandera'=> 'nada'
        ]);
    }
}
