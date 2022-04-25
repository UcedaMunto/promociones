<?php

namespace App\Form;

use App\Entity\PersonaEmpleado;
use App\Entity\TipoEmpleado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaEmpleadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('salario', NumberType::class, array('required' => false, 'attr'=>array('class'=>"form-control", 'pattern' => '\d{4}.\d{2}') ))
            ->add('isss', TextType::class, array('required'=>false, 'attr'=>array('class'=>"form-control", 'placeholder'=>"Escriba su numero de ISSS")))
            ->add('afp', TextType::class, array('required'=>false, 'attr'=>array('class'=>"form-control", 'placeholder'=>"Escriba su numero de AFP")))
            ->add('datos',  DatosPersonaType::class )
        ;
        $builder->get('datos')->remove('giro');
        $builder->get('datos')->remove('ncr');
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonaEmpleado::class,
            

        ]);
    }
}
 