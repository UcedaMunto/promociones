<?php

namespace App\Form;

use App\Entity\DepartamentoEmpresa;
use App\Entity\DiscusionDepartamento;
use App\Entity\DiscusionJefatura;
use Doctrine\Inflector\Rules\Pattern;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscusionJefaturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $paso = $options['paso'];

        if ($paso == 1) {
        $builder
           /* ->add('fecha', DateTimeType::class,  [ 
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"], 
            ]
            ) */
            ->add('descripcion', 
            TextareaType::class,  
            array('required' => true, 
            'attr'=>array('class'=>"form-control", 
            'placeholder'=>"Temas a tratar", 'maxlength' => 250)))   
            ->add('titulo', 
            TextareaType::class,  
            array('required' => true, 
            'attr'=>array('class'=>"form-control", 
            'placeholder'=>"Temas a tratar",'maxlength' => 35))) 
            ->add('departamentosEmpresa', EntityType::class, array(
                'required' =>true,
                'multiple'=> true,       
                'class' => DepartamentoEmpresa::class,
                'placeholder' => 'Miembros inolucrados?',
                'attr' => array('class'=>'myselect')))   
               
        ;
    } else {
        $builder
           /* ->add('fecha', DateTimeType::class,  [ 
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"], 
            ]
            ) 
            */
            ->add('titulo', 
            TextareaType::class,  
            array('required' => true, 
            'attr'=>array('class'=>"form-control", 
            'placeholder'=>"", 'maxlength' => 35))) 
            ->add('descripcion', 
            TextareaType::class,  
            array('required' => true, 
            'attr'=>array('class'=>"form-control", 
            'placeholder'=>"Temas a tratar", 'maxlength' => 250)))

            /*->add('departamentos', EntityType::class, array(
                'required' =>true,
                'multiple'=> true,       
                'class' => DiscusionDepartamento::class,
                'placeholder' => 'Miembros inolucrados?',
                'attr' => array('class'=>'myselect')))   */
               

           ->add('departamentosEmpresa', EntityType::class, array(
                'required' =>false,
                'multiple'=> true,       
                'class' => DepartamentoEmpresa::class,
                'placeholder' => 'Miembros inolucrados?',
                'attr' => array('class'=>'myselect'))) 
        ;
    }
}
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class' => DiscusionJefatura::class, 'paso'=>1
        ]);
    }


}
