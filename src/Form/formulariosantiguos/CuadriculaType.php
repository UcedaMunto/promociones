<?php

namespace App\Form;

use App\Entity\Aduana;
use App\Entity\Contenedor;
use App\Entity\Cuadricula;
use App\Entity\EnvioContenedor;
use App\Entity\Pais;
use App\Entity\PermisoNaviera;
use App\Entity\PersonaEmpleado;
use App\Repository\ContenedorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CuadriculaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cuaFactura = 'cuaFactura';     $paisOrigen="paisOrigen";       $declaracion="declaracion";
        $aduana="aduana";               $fecha="fecha";                 $empresaSeguridad="empresaSeguridad";
        $dm="dm";                       $cuadriculaFecha="cuadriculaFecha"; $permiso="permiso";
        $paisExpedicion="paisExpedicion";         $observaciones="observaciones";         $fechaSolicitud="fechaSolicitud";
        $fechaIngreso="fechaIngreso";   $autoriza="autoriza";           $soliMovimiento="soliMovimiento"; 
        $notificacionA="notificacionA"; $notiTelefono="notiTelefono";   $trackMensaje="trackMensaje";
        $usercuadricula="usercuadricula";       $contenedor="contenedor";   $pais="pais";   
        $descargadoPor="descargadoPor"; $viaje="viaje";
        $fechaArribo="fechaArribo";     

        $contenedorId= $options['contenedorId'];
        $campos= $options['campos'];
        $builder
            ->add($contenedor, EntityType::class,  array(
                'class' => Contenedor::class,
                'query_builder' => function (ContenedorRepository $er) use( $contenedorId){
                    return $er->createQueryBuilder('a')
                ->andWhere('a.id =:cliente')
                ->setParameter('cliente', $contenedorId);
                },
                'required' => true,'attr'=> array('class' => 'myselect'),
                )
            )
            ->add($viaje, TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"No. de viaje", "autocomplete"=>"off" ))
            )
            ->add('fechaTrack', DateType::class,  [ 
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"]
                    ]
            );
            if(!in_array( 'NO_BL', $campos)){
                $builder->add('numeroBl', TextType::class, array('required' => true ,
                'label'=>'BL',
                'attr'=>array('class'=>"form-control", 'placeholder'=>"BL?", "autocomplete"=>"off"))
                );
            }
            

            if(in_array($fecha, $campos))
                $builder->add($fecha,  DateType::class,  [
                    'label'=>'fecha',
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"],
                    ]
                );

            if(in_array($fechaSolicitud, $campos))
                $builder->add($fechaSolicitud,  DateType::class,  [ 
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"],
                    ]
                );
            if(in_array($fechaSolicitud.'_TIME', $campos)){
                $builder->add($fechaSolicitud,  DateTimeType::class,  [ 
                    'required' => false,
                    'widget' => 'single_text',
                    'attr' => ['class' => 'form-control', "autocomplete"=>"off", ],
                ]);
                $builder->add($permiso, EntityType::class,  array(
                    'required' => false,
                    'class' => PermisoNaviera::class,
                    'choice_label'=>'nombre',
                    'placeholder' => 'Permiso a necesitar?',
                    'attr'=> array('class' => 'myselect', "autocomplete"=>"off"),
                ));
            }

            if(in_array($fechaIngreso, $campos))
                $builder->add($fechaIngreso,  DateType::class,  [ 
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"],
                    ]
                );
            
            if(in_array($fechaArribo, $campos))
                $builder->add($fechaArribo,  DateType::class,  [ 
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"],
                    ]
                );
        
            if(in_array($soliMovimiento, $campos))
                $builder->add($soliMovimiento, TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Solicitud de movimiento", "autocomplete"=>"off"))
            );
        
            if(in_array($descargadoPor, $campos))
                $builder->add($descargadoPor, EntityType::class,  array(
                    'required' => false,
                    'class' => PersonaEmpleado::class,
                    'placeholder' => 'quien descarga?',
                    'attr'=> array('class' => 'myselect', "autocomplete"=>"off"),
                ));

            if(in_array($paisExpedicion, $campos))
                $builder->add($paisExpedicion, EntityType::class,  array(
                    'required' => false,
                    'class' => Pais::class,
                    'placeholder' => 'País de Expedición?',
                    'attr'=> array('class' => 'myselect', "autocomplete"=>"off"),
                ));
            
            if(in_array($paisOrigen, $campos))
                $builder->add($paisOrigen, EntityType::class,  array(
                    'required' => false,
                    'class' => Pais::class,
                    'placeholder' => 'País de Origen?',
                    'attr'=> array('class' => 'myselect', "autocomplete"=>"off"),
                ));
            
            if(in_array($pais, $campos))
                $builder->add($pais, EntityType::class,  array(
                    'required' => false,
                    'class' => Pais::class,
                    'placeholder' => 'País?',
                    'attr'=> array('class' => 'myselect', "autocomplete"=>"off"),
                ));
            
            if(in_array($aduana, $campos))
                $builder->add($aduana, EntityType::class,  array(
                    'required' => false,
                    'class' => Aduana::class,
                    'placeholder' => 'Aduana?',
                    'attr'=> array('class' => 'myselect', "autocomplete"=>"off"),
                ));


            
            if(in_array($cuaFactura, $campos))
                $builder->add($cuaFactura, TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control", 'placeholder'=>"No. de factura", "autocomplete"=>"off"))
                );
            
        
            if(in_array($empresaSeguridad, $campos))
                $builder->add($empresaSeguridad, TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control", 'placeholder'=>"Empresa de seguridad", "autocomplete"=>"off"))
                );
        
            if(in_array($permiso, $campos))
                $builder->add($permiso);
                
            if(in_array($observaciones, $campos))
                $builder->add($observaciones, TextareaType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Observaciones", "autocomplete"=>"off"))
            );

            if(in_array($autoriza, $campos))
                $builder->add($autoriza, TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control", 'placeholder'=>"Quien autoriza", "autocomplete"=>"off"))
             );
        
            if(in_array($notificacionA, $campos))
                $builder->add($notificacionA, TextareaType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"A notificar a:", "autocomplete"=>"off"))
            );
        
            if(in_array($notiTelefono, $campos))
                $builder->add($notiTelefono, TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Tel. de notificación", "autocomplete"=>"off"))
            );
        
            if(in_array($trackMensaje, $campos))
                $builder->add($trackMensaje, TextareaType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Mensaje de tracking", "autocomplete"=>"off")));


            $builder->add('envios', CollectionType::class, [
                    'entry_type' => EnvioType::class,
                    'entry_options' => ['label' => false, 'paso' => 30],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cuadricula::class,
            'campos' => null,
            'contenedorId'=> 0,
        ]);
    }
}
