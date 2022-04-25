<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\InfoEmpresa;
use App\Entity\Proveedor;
use App\Entity\Puertos;
use App\Entity\TipoCarga;
use App\Entity\TipoContenedor;
use App\Entity\WorkOrder;
use App\Repository\TipoCargaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $respuestas = $options['formularioTipo'];
        if($respuestas==0){
            $builder
            ->add('proveedor', EntityType::class, array(
                'required' => true, 
                'label'=>'Provider',
                'class' => Proveedor::class,
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('contactoBodega', TextareaType::class, array(
                'required' => true,
                'label'=>'Contact in warehouse',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"contact name",
                    'maxlength' => 100)
            ))
            ->add('direccionBodega', TextareaType::class, array(
                'required' => true,
                'label'=>'Address of the warehouse for pick up',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"warehouse address",
                    'maxlength' => 250)
            ))
            ->add('diaOrden', DateType::class, array(
                'required' => true,
                'label'=>'Order date',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
            ))
            ->add('diaRetiro', DateType::class, array(
                'required' => true,
                'label'=>'Pick up date',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
            ))
            ->add('horaRetiro', TimeType::class, array(
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'spinner form-control', 'autocomplete' => 'off', 'value'=> '00:00', 'pattern'=>"[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}" ],
            ))
            ->add('descripcionOrden', TextareaType::class, array(
                'required' => true,
                'label'=>'Work description',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"description",
                    'maxlength' => 350)
            ))
            ->add('comentarioExtra', TextareaType::class, array(
                'required' => true,
                'label'=>'Additional comments',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"commnet",
                    'maxlength' => 200)
            ))
            ->add('tipoContenedor',  EntityType::class, array(
                'required' => true,
                'label'=>'Return equip delivery terminal',
                'class'=>TipoContenedor::class,
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('retiroContenedorVacio', TextareaType::class, array(
                'required' => true,
                'label'=>'Empty container',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"location",
                    'maxlength' => 250)
            ))
            ->add('puertoCarga', EntityType::class, array(
                'required' => true,
                'label'=>'Return equip delivery terminal',
                'class'=>Puertos::class,
                'attr'=> array('class' => 'myselect'),


            ))
            ->add('booking', BookingType::class )
            ->add('infoEmpresa', EntityType::class, array(
                'required' => true, 
                'class' => InfoEmpresa::class,
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('personaAutoriza', TextareaType::class, array(
                'required' => true,
                'label'=>'Work autorized by',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"authorized by",
                    'maxlength' => 100)
            ))
            ->add('cargoPersona', TextareaType::class, array(
                'required' => true,
                'label'=>'Signature',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"signature",
                    'maxlength' => 50)
            ))
            ->add('cargaTipo',EntityType::class, array(
                'required' => false,
                'mapped' => false,
                'multiple' =>true,
                'label'=>'Commodity:',
                'class' => TipoCarga::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
                'query_builder' => function(TipoCargaRepository $er ){
                    return $er->createQueryBuilder('a');
                }
            ))
            
            
            
            
        ;
        }else{
            $builder
            ->add('proveedor', EntityType::class, array(
                'required' => true, 
                'label'=>'Provider',
                'class' => Proveedor::class,
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('contactoBodega', TextareaType::class, array(
                'required' => true,
                'label'=>'Contact in warehouse',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"contact name",
                    'maxlength' => 100)
            ))
            ->add('direccionBodega', TextareaType::class, array(
                'required' => true,
                'label'=>'Address of the warehouse for pick up',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"warehouse address",
                    'maxlength' => 250)
            ))
            ->add('diaOrden', DateType::class, array(
                'required' => true,
                'label'=>'Order date',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
            ))
            ->add('diaRetiro', DateType::class, array(
                'required' => true,
                'label'=>'Pick up date',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
            ))
            ->add('horaRetiro', TimeType::class, array(
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'spinner form-control', 'autocomplete' => 'off', 'value'=> '00:00', 'pattern'=>"[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}" ],
            ))
            ->add('descripcionOrden', TextareaType::class, array(
                'required' => true,
                'label'=>'Work description',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"description",
                    'maxlength' => 350)
            ))
            ->add('comentarioExtra', TextareaType::class, array(
                'required' => true,
                'label'=>'Additional comments',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"commnet",
                    'maxlength' => 200)
            ))
            ->add('tipoContenedor', TextType::class, array(
                'required' => true,
                'label'=>'Container tipe',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"tipe",
                    'maxlength' => 100)
            ))
            ->add('retiroContenedorVacio', TextareaType::class, array(
                'required' => true,
                'label'=>'Empty container',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"location",
                    'maxlength' => 250)
            ))
            ->add('puertoCarga', EntityType::class, array(
                'required' => true,
                'label'=>'Return equip delivery terminal',
                'class'=>Puertos::class,
                'attr'=> array('class' => 'myselect'),


            ))
            ->add('booking', BookingType::class )
            ->add('infoEmpresa', EntityType::class, array(
                'required' => true, 
                'class' => InfoEmpresa::class,
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('personaAutoriza', TextareaType::class, array(
                'required' => true,
                'label'=>'Work autorized by',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"authorized by",
                    'maxlength' => 100)
            ))
            ->add('cargoPersona', TextareaType::class, array(
                'required' => true,
                'label'=>'Signature',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"signature",
                    'maxlength' => 50)
            ))
            ->add('cargaTipo',EntityType::class, array(
                'required' => false,

                'multiple' =>true,
                'label'=>'Commodity:',
                'class' => TipoCarga::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
                'query_builder' => function(TipoCargaRepository $er ){
                    return $er->createQueryBuilder('a');
                }
            ))
            
            
            
            
        ;
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WorkOrder::class,
            'formularioTipo' => 0,
        ]);
    }
}
