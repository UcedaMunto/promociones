<?php

namespace App\Form;

use App\Entity\Marca;
use App\Entity\Modelo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array('required' => true , 'attr'=>array('class'=>"form-control", 'placeholder'=>"nombre")))
            ->add('codigo', TextType::class, 
                array('required' => false,
                'empty_data' => '', 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"código")))
            ->add('marca', EntityType::class,  array(
                'class' => Marca::class,
                'placeholder' => 'marca?', 
                'required' => true,'attr'=> array('class' => 'myselect'))            
            )
            ->add('pesokm', NumberType::class, array('required' => true, 'attr'=>array('class'=>"form-control", "placeholder"=>"Peso en kilogramos")))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modelo::class,
        ]);
    }
}
