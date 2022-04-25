<?php

namespace App\Form;

use App\Entity\Consignatario;
use App\Entity\Contenedor;
use App\Entity\Puertos;
use App\Entity\Aduana;
use App\Entity\Yardas;
use App\Entity\DockReceipt;
use App\Entity\Envio;
use App\Repository\PuertosRepository;
use App\Entity\TipoContenedor;
use App\Repository\AduanaRepository;
use App\Repository\EnvioRepository;
use App\Repository\TipoContenedorRepository;
use App\Repository\YardasRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class ContenedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $paso = $options['paso'];
        $yarda = $options['yarda'];
        $aduana = $options['aduana'];

        $trackeo = $options['trackeo'];
        if($trackeo == true){
            $builder
            ->add('dockreceipt', DockReceiptType::class, ['trackeo'=> $trackeo])
            ->add('fechaEnbarcacion',  DateType::class,  [ 
                'required' => false, 'widget' => 'single_text', 'html5' => false, 
                'attr' => ['class' => 'datepicker form-control recalcarPaso','autocomplete' => 'off'],
                ]
            )
            ->add('fechaZarpe',  DateType::class,  [ 
                'required' => false, 'widget' => 'single_text', 'html5' => false, 
                'attr' => ['class' => 'datepicker form-control recalcarPaso','autocomplete' => 'off'],
                ]
            )
            ->add('fechaArribo',  DateType::class,  [ 
                'required' => false, 'widget' => 'single_text', 'html5' => false, 
                'attr' => ['class' => 'datepicker form-control recalcarPaso','autocomplete' => 'off'],
                ]
            )
            ->add('fechaArriboVerificada',  DateType::class,  [ 
                'required' => false, 'widget' => 'single_text', 'html5' => false, 
                'attr' => ['class' => 'datepicker form-control recalcarPaso','autocomplete' => 'off'],
                ]
            )
            ->add('fechaMarcadoDescargar',  DateType::class,  [ 
                'required' => false, 'widget' => 'single_text', 'html5' => false, 
                'attr' => ['class' => 'datepicker form-control recalcarPaso','autocomplete' => 'off'],
                ]
            )
            ->add('fechaDescargado',  DateType::class,  [ 
                'required' => false, 'widget' => 'single_text', 'html5' => false, 
                'attr' => ['class' => 'datepicker form-control recalcarPaso','autocomplete' => 'off'],
                ]
            )
            ;
        }else{ // ESTA ES LA RUTA COMUN PARA CUANDO SE ESTA CREANDO O EDITANDO DATOS DE UN CONTENEDOR
            if($paso==0){
                $builder
                ->add('codigo', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Código")))
                //*---------------estos datos se cambiaron de cuadricula a Contenedor
                    ->add('paisOrigen', TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"Pais Origen - cuadrícula")))
                    ->add('viaje', TextType::class, array('required' => true , 
                    'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Número de viaje")))
                /*--------------------------------------------------------------------------------*/
                ->add('listaAutos',EntityType::class,  array(
                    'class' => Envio::class,
                    'query_builder' => function (EnvioRepository $er){
                        return $er->createQueryBuilder('a')
                        ->leftJoin('a.detalleCompra', 'dc')
                        ->leftJoin('dc.compra', 'co')
                        ->where('co.compraEstado = 4 or co.compraEstado = 5')
                        ->orderBy('a.id', 'ASC');
                    },
                    'placeholder' => 'Consignatario?',
                    'mapped'=>false,
                    'multiple'=>true,
                    'required' => false,'choice_label'=>'id','attr'=> array('class' => 'myselect2'))
                    )
                ->add('consignatario', EntityType::class,  array('class' => Consignatario::class,
                    'placeholder' => 'Consignatario?',
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
                ->add('tipoContenedor', EntityType::class, array(
                        'class' => TipoContenedor::class,
                        'required' => false,
                        'placeholder' => 'tipo contenedor?',
                        'query_builder' => function (TipoContenedorRepository $er){
                            return $er->createQueryBuilder('a')
                            ->orderBy('a.id', 'ASC');
                        },
                        'choice_attr' => function ($val, $key, $index) {
                            return array('data-peso' => $val->getPeso()
                            );
                        },
                        'choice_label'=>'tamano',
                        'required' => true,'attr'=> array('class' => 'myselect2'))
                    )
                ->add('dockreceipt', DockReceiptType::class)
                ->add('puerto',EntityType::class,  array(
                    'class' => Puertos::class,
                    'query_builder' => function (PuertosRepository $er){
                        return $er->createQueryBuilder('a')
                        ->andWhere('a.departamento IS NOT NULL')
                       // ->setParameter('val', 10)
                        ->orderBy('a.id', 'ASC');
                    },
                    'placeholder' => 'ciudad - grua?', 
                    'required' => true,'attr'=> array('class' => 'myselect'),
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-recomendado' => $val->getNombre());
                    })
                ) 
                ->add('aduana', EntityType::class,  array('class' => Aduana::class,
                    'placeholder' => 'destino?',
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
    
                ->add('yarda', EntityType::class,  array(
                    'query_builder' => function (YardasRepository $er){
                        return $er->yardasActivas();
                    },
                    'class' => Yardas::class,
                    'placeholder' => 'Punto de partida?',
                    'required' => true,'choice_label'=>'nombreYPuerto','attr'=> array('class' => 'myselect')))
                    
                ->add('fechaArribo',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control','autocomplete' => 'off'],
                    ]
                )
                ->add('fechaEnbarcacion',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control','autocomplete' => 'off'],
                    ]
                )
                ->add('booking', TextType::class, array(
                    'required' => true , 
                    'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Booking"))
                )
                ;
    
                $builder->add('envioContenedors', CollectionType::class, [
                    'entry_type' => EnvioContenedorType::class,
                    'entry_options' => ['label' => false],
                ]);
    
                $builder->add('refacciones', CollectionType::class, [
                    'entry_type' => RefaccionesType::class,
                    'entry_options' => ['label' => false],
                ]);
            }
            if($paso==1){ //Ediciones
                $builder
                ->add('codigo', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Código")))
                //*---------------estos datos se cambiaron de cuadricula a Contenedor
                    ->add('paisOrigen', TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"Pais Origen - cuadrícula")))
                    ->add('viaje', TextType::class, array('required' => true , 
                    'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Número de viaje")))
                /*--------------------------------------------------------------------------------*/
                ->add('listaAutos',EntityType::class,  array(
                    'class' => Envio::class,
                    'placeholder' => false,
                    'query_builder' => function (EnvioRepository $er){
                        return $er->createQueryBuilder('a')
                        ->leftJoin('a.detalleCompra', 'dc')
                        ->leftJoin('a.envioContedor', 'ec')
                       // ->setParameter('val', 10)
                        ->orderBy('a.id', 'ASC');
                    },
                    'placeholder' => 'Consignatario?',
                    'mapped'=>false,
                    'multiple'=>true,
                    'required' => false,'choice_label'=>'id','attr'=> array('class' => 'myselect2'))
                )
                ->add('aduana', EntityType::class,  array('class' => Aduana::class,
                    'placeholder' => false,
                    'query_builder' => function (AduanaRepository $er)use($aduana){
                        return $er->createQueryBuilder('a')
                        ->where('a.id = :aduana')
                        ->setParameter('aduana', $aduana);
                    },
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
    
                ->add('yarda', EntityType::class,  array(
                    'query_builder' => function (YardasRepository $er){
                        return $er->yardasActivas();
                    },
                    'class' => Yardas::class,
                    'required' => true,'choice_label'=>'nombreYPuerto','attr'=> array('class' => 'myselect')))
               
                ->add('consignatario', EntityType::class,  array('class' => Consignatario::class,
                    'placeholder' => 'Consignatario?',
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
                ->add('tipoContenedor', EntityType::class, array(
                    'class' => TipoContenedor::class,
                    'required' => false,
                    'placeholder' => 'tipo contenedor?',
                    'query_builder' => function (TipoContenedorRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC');
                    },
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-peso' => $val->getPeso()
                        );
                    },
                    'choice_label'=>'tamano',
                    'required' => true,'attr'=> array('class' => 'myselect2'))
                    )
                ->add('dockreceipt', DockReceiptType::class)
                /*->add('puerto',EntityType::class,  array(
                    'class' => Puertos::class,
                    'query_builder' => function (PuertosRepository $er){
                        return $er->createQueryBuilder('a')
                        ->andWhere('a.departamento IS NOT NULL')
                       // ->setParameter('val', 10)
                        ->orderBy('a.id', 'ASC');
                    },
                    'placeholder' => 'ciudad - grua?', 
                    'required' => true,'attr'=> array('class' => 'myselect'),
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-recomendado' => $val->getNombre());
                    })
                ) */
                
                ->add('fechaArribo',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control','autocomplete' => 'off'],
                    ]
                )
                ->add('fechaEnbarcacion',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control','autocomplete' => 'off'],
                    ]
                )
                ->add('booking', TextType::class, array(
                    'required' => true , 
                    'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Booking"))
                )
                ;
    
                $builder->add('envioContenedors', CollectionType::class, [
                    'entry_type' => EnvioContenedorType::class,
                    'entry_options' => ['label' => false, 'tipo' => 'normal'],
                ]);
    
                $builder->add('refacciones', CollectionType::class, [
                    'entry_type' => RefaccionesType::class,
                    'entry_options' => ['label' => false],
                ]);
            }
            if($paso==-1){ //Formulario completo
                $builder
                ->add('consignatario', EntityType::class,  array('class' => Consignatario::class,
                    'placeholder' => 'Consignatario?',
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
                ->add('tipoContenedor', EntityType::class, array(
                        'class' => TipoContenedor::class,
                        'placeholder' => 'tipo contenedor?',
                        'query_builder' => function (TipoContenedorRepository $er){
                            return $er->createQueryBuilder('a')
                            ->orderBy('a.id', 'ASC');
                        },
                        'choice_attr' => function ($val, $key, $index) {
                            return array('data-peso' => $val->getPeso()
                            );
                        },
                        'choice_label'=>'tamano',
                        'required' => true,'attr'=> array('class' => 'myselect2')))
                ->add('dockreceipt', DockReceiptType::class)
                ->add('puerto',EntityType::class,  array(
                    'class' => Puertos::class,
                    'query_builder' => function (PuertosRepository $er){
                        return $er->createQueryBuilder('a')
                        ->andWhere('a.departamento IS NOT NULL')
                       // ->setParameter('val', 10)
                        ->orderBy('a.id', 'ASC');
                    },
                    'placeholder' => 'ciudad - grua?', 
                    'required' => true,'attr'=> array('class' => 'myselect'),
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-recomendado' => $val->getNombre());
                    })
                ) 
                ->add('aduana', EntityType::class,  array('class' => Aduana::class,
                    'placeholder' => 'destino?',
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
    
                ->add('yarda', EntityType::class,  array(
                    'query_builder' => function (YardasRepository $er){
                        return $er->yardasActivas();
                    },
                    'class' => Yardas::class,
                    'placeholder' => 'Punto de partida?',
                    'required' => true,'choice_label'=>'nombreYPuerto','attr'=> array('class' => 'myselect')))
                ->add('fechaArribo',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
                    ]
                )
                ->add('fechaEnbarcacion',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
                    ]
                )
                ->add('fechaDescargado',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control','autocomplete' => 'off'],
                    ]
                )
                ->add('fechaPagoDescarga',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control','autocomplete' => 'off'],
                    ]
                )
                ->add('fechaZarpe',  DateType::class,  [ 
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => ['class' => 'datepicker form-control','autocomplete' => 'off'],
                    ]
                )
                ->add('descripcion', TextareaType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control", 'placeholder'=>"Descripción")))
                ->add('codigo', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Código")))
                ->add('cupos', IntegerType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Código")))
                ->add('costoDescarga', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                    'attr'=>array('class'=>"form-control" , 'placeholder'=>"Cost. Descarga")))
                ->add('costoEnvioDocumentos', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"De documentos")))
                ->add('costoEnvioPago', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"Envío de pago")))
                ->add('invoice', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Invoice?")))
                ->add('otrosCostos', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"Otros")))
                ->add('pagoEmpresa', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"Pago empresa")))
                ->add('utilidad', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"Utilidad")))
                ->add('booking', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Booking")))
                ->add('costoComision', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                    'attr'=>array('class'=>"form-control" , 'placeholder'=>"Comisión")))
                ->add('costoContenedorYarda', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"Contenedor yarda")))
                ->add('costoTerrestre', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"Terrestre")))
                ->add('costoYarda', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"de Yarda")))
                ->add('otrosCostosFlete', MoneyType::class,  array('required' => false , 'currency'=>'USD',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"Otros de flete")))
                ->add('notasFlete', TextareaType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Notas de flete")))
                //->add('pagoDescargas')
                ;
            }
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'allow_extra_fields' =>true,
            'data_class' => Contenedor::class,
            'yarda'=> 0,
            'aduana'=> 0,
            'paso' => 0,
            'trackeo' => false,
            
        ]);
    }
}
