<?php

namespace App\Form;

use App\Entity\CtlTipoPromocion;
use App\Entity\PromoPromociones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class PromoPromocionesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaInicio', DateTimeType::class,  [
                'label'=> 'Inicia',
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"], 
            ]
            )
            ->add('fechaFin', DateTimeType::class,  [
                'label'=> 'Ternima',
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"], 
            ]
            )
            ->add('codigo', TextType::class, array('required' => true,'label'=>'Código', 'attr'=>array('class'=>"form-control", 'placeholder'=>"Código")))
            ->add('activo', CheckboxType::class, array(
                'required'=>true,
                'label'=>'promoción activa?',
                'attr'=>array('class'=>"form-control" ,)
            ))
            ->add('nombre', TextType::class, array('required' => true,'label'=>'Nombre', 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"nombre")))
            ->add('descripcion', TextareaType::class, array('required' => false,'label'=>'Descripción', 'attr'=>array('class'=>"form-control", 'placeholder'=>"Descripción")))
            ->add('idTipo', EntityType::class,  array(
                
                'label'=> 'Tipo de promoción',
                'required' => true,
                'class' => CtlTipoPromocion::class,
                'placeholder' => 'tipo?',
                'attr'=> array('class' => 'myselect','disabled'=>false),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PromoPromociones::class,
        ]);
    }
}
