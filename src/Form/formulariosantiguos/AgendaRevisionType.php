<?php

namespace App\Form;

use App\Entity\AgendaRevision;
use App\Entity\EstadoRevision;
use App\Entity\UsuarioEmpleado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgendaRevisionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextareaType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Describa el problema"
                )))
            ->add('duracionRecordatorio', IntegerType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Ingresa la cantidad de días que se te mostrará la tarea"
                )))
            ->add('encargado', EntityType::class,  array(
                'class' => UsuarioEmpleado::class,
                'multiple'=>FALSE,
                'placeholder' => 'etiquete al encargado?', 
                'required' => true,'attr'=> array('class' => 'myselect'))
            )
            ->add('estado', EntityType::class,  array(
                'class' => EstadoRevision::class,
                'multiple'=>FALSE,
                'placeholder' => 'los resueltos no se notificarán?', 
                'required' => true,'attr'=> array('class' => 'form-control'))
            )
            ->add('fechaInicio',  DateType::class,  [ 
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off' ],
            ]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AgendaRevision::class,
        ]);
    }
}
