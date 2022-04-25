<?php

namespace App\Form;

use App\Entity\PromoEstablecimiento;
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
use App\Entity\PromoCategoria;

class PromoEstablecimientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class,  array('label'=>'Nombre', 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"nombre")))
            ->add('telefono', TextType::class,  array('label'=>'Teléfono', 'required'=> true, 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"Teléfono")))
            ->add('direccion', TextareaType::class, array('required' => true,'label'=>'Dirección', 'attr'=>array('class'=>"form-control", 'placeholder'=>"Dirección")))
            ->add('Activo', CheckboxType::class, array(
                'required'=>false,
                'label'=>'Activo?',
                'attr'=>array('class'=>"form-control" ,)
            ))
            ->add('archivoLogoTemp',  ArchivoType::class, array('label'=>false, 'titulo'=> 'Logo', 'require' =>true  ) )
            ->add('archivoBannerTemp',  ArchivoType::class, array('label'=>false, 'titulo'=> 'Banner', 'require' =>false ) )
            ->add('categorias', EntityType::class,  array(
                'label'=>'Categoria',
                'multiple' => true,
                'required' => true,
                'class' => PromoCategoria::class,
                'placeholder' => 'categoria?',
                'attr'=> array('class' => 'myselect'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PromoEstablecimiento::class,
        ]);
    }
}
