<?php

namespace App\Form;

use App\Entity\PromoSucursal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Municipio;
use App\Entity\PromoEstablecimiento;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PromoSucursalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dump($objPromoEstablecimiento); die; 
        $bloquearEstablecimiento = false;
        $options['establecimiento'] != '0'? $bloquearEstablecimiento = true: $bloquearEstablecimiento=false; 
        
        $builder
            ->add('nombre', TextType::class, array('label'=>'Nombre', 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"nombre")))

            ->add('Activo', CheckboxType::class, array(
                'required'=>true,
                'label'=>'Activo?',
                'attr'=>array('class'=>"form-control" ,)
            ))
            ->add('direccion', TextareaType::class, array('required' => true,'label'=>'Dirección', 'attr'=>array('class'=>"form-control", 'placeholder'=>"Dirección")))
            ->add('idEstablecimiento', EntityType::class,  array(
                'label'=>'Establecimiento',
                'required' => true,
                'class' => PromoEstablecimiento::class,
                'attr'=> array('class' => 'myselect','disabled'=>$bloquearEstablecimiento),
            ))
            ->add('idMunicipio', EntityType::class,  array(
                'label'=>'Municipio',
                'required' => true,
                'class' => Municipio::class,
                'placeholder' => 'Municipio?',
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('urlUbicacionMapa', TextType::class, array('label'=>'Url de hubicación', 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"url")))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PromoSucursal::class,
            'establecimiento' => 0,
        ]);
    }
}
