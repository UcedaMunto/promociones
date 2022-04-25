<?php

namespace App\Form;

use App\Entity\PromoCategoria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PromoCategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array('required' => false, 'label'=>'Nombre', 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"nombre")))
            ->add('descripcion', TextareaType::class, array('required' => false,'label'=>'Descripción', 'attr'=>array('class'=>"form-control", 'placeholder'=>"Descripción")))
            ->add('Activo', CheckboxType::class, array(
                'required'=>false,
                'label'=>'Activo?',
                'attr'=>array('class'=>"form-control" ,)
            ))
            ->add('archivoLogo',  ArchivoType::class, array('label'=>false, 'titulo'=> 'Logo', 'require' =>true  ) )
            ->add('archivoBanner',  ArchivoType::class, array('label'=>false, 'titulo'=> 'Banner', 'require' =>true  ) )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PromoCategoria::class,
        ]);
    }
}
