<?php

namespace App\Form;

use App\Entity\Comentarios;
use App\Entity\EstadoComentario;
use App\Entity\TipoComentario;
use App\Entity\UsuarioEmpleado;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ComentariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $respuesta = $options['respuesta'];
        if($respuesta==0){
            $builder
            ->add('titulo', TextareaType::class, array('required' => true , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Describa el problema en un pequeño título")))
            ->add('mensaje', TextareaType::class, array('required' => true , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Describa el problema y seleccione a los implicados para dar seguimiento")))
            ->add('etiquetados', EntityType::class,  array(
                'class' => UsuarioEmpleado::class,
                'multiple'=>true,
                'placeholder' => 'etiquete a quien interese por favor?', 
                'required' => true,'attr'=> array('class' => 'myselect'))
            )
            //->add('vistas')
            //->add('autor')
            //->add('compra')
            //->add('respuestas')
            ->add('tipo', EntityType::class,  array(
                'class' => TipoComentario::class,
                'placeholder' => 'Según sea el tipo de comentario seleccionar?', 
                'required' => true,'attr'=> array('class' => 'form-control'))
            )
            ->add('estado', EntityType::class,  array(
                'class' => EstadoComentario::class,
                'placeholder' => 'Estado del comentario opcional?', 
                'required' => true,'attr'=> array('class' => 'form-control'))
            );
        }
        if($respuesta==1){
            $builder
            ->add('mensaje', TextareaType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Describa el problema y seleccione a los implicados para dar seguimiento"
                )))
            ->add('etiquetados', EntityType::class,  array(
                'class' => UsuarioEmpleado::class,
                'multiple'=>true,
                'placeholder' => 'etiquete a quien interese por favor?', 
                'required' => false,'attr'=> array('class' => 'myselect'))
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comentarios::class,
            'respuesta' => 0,
        ]);
    }
}


