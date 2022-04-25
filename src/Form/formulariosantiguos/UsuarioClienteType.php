<?php

namespace App\Form;

use App\Entity\UsuarioCliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario', TextType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"INGRESE SU NICK",'maxlength' => 100 )))
            ->add('password', PasswordType::class, array('required' => true, 'attr' =>array('class'=>"form-control", 'maxlength' => 200    ))   )
           // ->add('creacion')
           // ->add('actualizacion')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UsuarioCliente::class,
        ]);
    }
}
