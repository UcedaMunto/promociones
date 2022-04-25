<?php

namespace App\Form;

use App\Entity\Puertos;
use App\Entity\Yardas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class YardasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre de la yarda"))
            )
            ->add('direccion', TextareaType::class, array('required' => true , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Dirección"))
            )
            ->add('correo', EmailType::class, array('required' => true , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"correo"))
            )
            ->add('correo1', EmailType::class, array('required' => true , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"correo 1")))
            ->add('nombreEmpresa', TextType::class, array('required' => true , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre de la empresa")))
            ->add('estado', IntegerType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"para activarlo 1"))
            )
            ->add('puerto', EntityType::class,  array(
                'required' => false,
                'class' => Puertos::class,
                'placeholder' => 'Aduana destino?',
                'attr'=> array('class' => 'myselect'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Yardas::class,
        ]);
    }
}
