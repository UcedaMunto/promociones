<?php

namespace App\Form;

use App\Entity\PromoAviso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CtlTipoAviso;


class PromoAvisoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array('label'=>'Nombre', 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"nombre")))
            ->add('descripcion', TextareaType::class, array('required' => false,'label'=>'Descripción', 'attr'=>array('class'=>"form-control", 'placeholder'=>"Descripción")))
            ->add('activo', CheckboxType::class, array(
                'required'=>false,
                'label'=>'Activo?',
                'attr'=>array('class'=>"form-control" ,)
            ))
            ->add('idTipoAviso', EntityType::class,  array(
                'label'=>'Tipo de aviso',
                'required' => true,
                'class' => CtlTipoAviso::class,
                'placeholder' => 'tipo?',
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('archivoLogoTemp',  ArchivoType::class, array('label'=>false, 'titulo'=> 'Logo', 'require' =>true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PromoAviso::class,
        ]);
    }
}
