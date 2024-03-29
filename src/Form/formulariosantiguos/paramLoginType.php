<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class paramLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', TextType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Usuario?" )) )
            ->add('pass', PasswordType::class,  array('required' => true , 'attr'=>array( 'class'=>"form-control" , 'placeholder'=>"Pass?" )) )
            ->add('token', TextType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Contacte con inbakcar para obtener su clave" )) )
            ->add('enviar', SubmitType::class, ['attr' => ['class' => 'btn btn-primary',],]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            
        ]);
    }
}
