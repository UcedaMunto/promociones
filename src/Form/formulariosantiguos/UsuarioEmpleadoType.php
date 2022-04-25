<?php

namespace App\Form;

use App\Entity\TipoCliente;
use App\Entity\TipoEmpleado;
use App\Entity\UsuarioEmpleado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioEmpleadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario', TextType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"INGRESE SU NICK",'maxlength' => 20 )))
            ->add('password', PasswordType::class, array('required' => true, 'attr' =>array('class'=>"form-control", 'maxlength' => 200   ))   )
           // ->add('creacion')
            ->add('rolesEmpleado',EntityType::class,  array(
                'class' => TipoEmpleado::class, 'by_reference'=> false,
                'placeholder' => 'Que roles tendrá el empleado?', 
                'mapped'=>false,
                'multiple'=>true,
                'required' => false,
                'choice_label'=>'nombre','attr'=> array('class' => 'myselect2'))
                )
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UsuarioEmpleado::class,
        ]);
    }
}
