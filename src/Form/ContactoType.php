<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CtlTipoContacto;
use App\Entity\Contacto;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array('label'=>'Nombre', 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"nombre")))
            ->add('telefono',TextType::class, array('label'=>'Teléfono', 'attr'=>array('readonly' => false,'class'=>"form-control", 'placeholder'=>"Teléfono")))
            ->add('idTipoContacto', EntityType::class,  array(
                'required' => true,
                'class' => CtlTipoContacto::class,
                'placeholder' => 'tipo?',
                'attr'=> array('class' => 'myselect' ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Contacto::class,
        ]);
    }
}
