<?php

namespace App\Form;

use App\Entity\ComentarioReunion;
use App\Entity\DiscusionJefatura;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComentarioReunionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $respuestas = $options['respuestas'];
        if($respuestas==0){
        $builder
            ->add('mensaje', TextareaType::class, array(
                'required' => true,
                'attr'=>array('class'=>"form-control" , 
                'placeholder'=>"comentario", 'maxlength' => 250)
                ))
            //->add('fecha')
            ->add('tituloComent', TextareaType::class, array(
                'required' => true,
                'attr'=>array('class'=>"form-control" , 
                'placeholder'=>"Titulo", 'maxlength' => 75)
                ))
            //->add('usuarioEmpleado')
            /*->add('discusionJefatura', EntityType::class,  array(
                'required' => false,
                'class' => DiscusionJefatura::class,
                'placeholder' => 'Selecione la discusion',
                'attr'=> array('class' => 'myselect'),
                ))*/
            //->add('respuesta')
        ;
        }
        if($respuestas==1){
            $builder

            ->add('mensaje', TextareaType::class, array(
                'required' => true,
                'attr'=>array('class'=>"form-control" , 
                'placeholder'=>"comentario",'maxlength' => 250)
                ))
        ;
        } 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ComentarioReunion::class,
            'respuestas' => 0,
        ]);
    }
}
