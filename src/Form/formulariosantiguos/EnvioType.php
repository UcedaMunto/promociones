<?php

namespace App\Form;

use App\Entity\Aduana;
use App\Entity\Cilindrage;
use App\Entity\Cities;
use App\Entity\Envio;
use App\Entity\Flete;
use App\Entity\TipoVehiculo;
use App\Repository\CitiesRepository;
use App\Repository\FleteRepository;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnvioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $paso = $options['paso'];
        $sucursal = $options['sucursal'];
        $flete = $options['flete'];

        if($paso == 1 ) { //INGRESO DE DATOS
            $builder
                ->add('precioFlete', 
                MoneyType::class,  array('required' => false , 'currency'=>'USD',  'attr'=>array('class'=>"form-control" , 'placeholder'=>"Precio Flete")))
                ->add('GruaPrecio',
                MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Grua precio")))
                ->add('precioBL',
                MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('empty_data' => '15','class'=>"form-control" , 'placeholder'=>"Precio BL")))
                ->add('detalleCompra', DetalleCompraType::class,['paso' =>1,])        //Se trae el formulario completo
                ->add('flete', EntityType::class,  array(               //Mete datos del formulario en un Select
                    'query_builder' => function (FleteRepository $er){
                        return $er->fleteYardasActivas();
                    },
                    /*function (FleteRepository $er){
                        return $er->createQueryBuilder('a')
                        ->leftJoin('a.yarda', 'yarda')
                        ->andWhere('yarda.estado = 1');
                    },*/
                    'required' => false ,
                    'class' => Flete::class,
                    'placeholder' => 'flete puerto?',
                    'attr'=> array('class' => 'myselect'),
                    'choice_label'=>'combo',
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-recomendado' => $val->getPrecioVenta());
                }))
                ->add('aduana', EntityType::class,  array(
                    'required' => false,
                    'class' => Aduana::class,
                    'placeholder' => 'Aduana destino?',
                    'attr'=> array('class' => 'myselect'),
                ))
                ->add('cantidad', TextType::class, array('required' => false , 
                        'attr'=>array('class'=>"form-control", 'placeholder'=>"SUMA DE LOS PRECIOS, SUMA DE COSTOS"))
                )
                ->add('codigo', PasswordType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Código de descuento"))
                )
                ->add('enYarda', CheckboxType::class,  array('required' => false ,
                    'attr'=>array('class'=>"form-control" , )))

                ->add('enCola', CheckboxType::class,  array('required' => false ,
                    'attr'=>array('class'=>"form-control" , )))
                
                ->add('repuestos', CheckboxType::class,  array('required' => false,
                    'attr'=>array('class'=>"form-control")))
                ;
        }

        if(($paso <=13 && $paso>5)  || $paso==21){ //--------------- FOTOS DE GRUA O YARDA Antes del dockreceipt
            if( $flete == NULL){ //Sucursal solo puede ser ingresado una vez la bandera sucursal dice si se ha seleccionado en algún momento
                $builder->add('flete', EntityType::class, array(               //Mete datos del formulario en un Select
                    'query_builder' => function (FleteRepository $er){
                        return $er->fleteYardasActivas();
                    },
                    'required' => false ,
                    'class' => Flete::class,
                    'placeholder' => 'flete puerto?',
                    'attr'=> array('class' => 'myselect' ),
                    'choice_label'=>'combo',
                    'choice_attr' => function ($val, $key, $index) {            // Mete atributos dentro de la etiqueta Option 
                        return array('data-recomendado' => $val->getPrecioVenta());}
                    )
                );
            }else{
                $builder->add('flete', EntityType::class, array(               //Mete datos del formulario en un Select
                        'required' => false ,
                        'class' => Flete::class,
                        'placeholder' => 'flete puerto?',
                        'attr'=> array('class' => 'myselect' ),
                        'choice_label'=>'combo',
                        'choice_attr' => function ($val, $key, $index) {            // Mete atributos dentro de la etiqueta Option 
                        return array('data-recomendado' => $val->getPrecioVenta());}
                    )
                );
            }
            
            $builder
                /*
                ->add('enYarda', CheckboxType::class,  array('required' => false,
                    'attr'=>array('class'=>"form-control", ))
                )
                ->add('repuestos', CheckboxType::class,  array('required' => false ,
                    'attr'=>array('class'=>"form-control" ))
                )*/
                ->add('precioFlete',
                    MoneyType::class,  array('required' => false , 'currency'=>'USD',  'attr'=>array('class'=>"form-control" , 'placeholder'=>"Precio Flete"))
                )
                ->add('GruaPrecio',
                    MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Grua precio"))
                )
                ->add('precioBL',
                    MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('empty_data' => '15','class'=>"form-control" , 'placeholder'=>"Precio BL"))
                )
                ->add('detalleCompra', DetalleCompraType::class, array('paso'=> $paso, 'sucursal' =>$sucursal))        //Se trae el formulario completo de acuerdo al $paso
                
                ->add('aduana', EntityType::class,  array(
                    'required' => false,
                    'class' => Aduana::class,
                    'placeholder' => 'Aduana destino?',
                    'attr'=> array('class' => 'myselect'),)
                )
                ->add('cantidad', TextType::class, array('required' => false , 
                        'attr'=>array('class'=>"form-control", 'placeholder'=>"SUMA DE LOS PRECIOS, SUMA DE COSTOS"))
                )
                ->add('codigo', PasswordType::class, array('required' => false , 
                        'attr'=>array('class'=>"form-control", 'placeholder'=>"Código de descuento"))
                )
                ->add('enCola', CheckboxType::class,  array('required' => false , 
                    'attr'=>array('class'=>"form-control"  )   ))
            ;
        }

        if(($paso <= 5 && $paso>1) || $paso==21){ //--------------- FOTOS DE GRUA O YARDA Antes del dockreceipt
            if( $flete == NULL){ //Sucursal solo puede ser ingresado una vez la bandera sucursal dice si se ha seleccionado en algún momento
                $builder->add('flete', EntityType::class, array(               //Mete datos del formulario en un Select
                    'query_builder' => function (FleteRepository $er){
                        return $er->fleteYardasActivas();
                    },
                    'required' => false ,
                    'class' => Flete::class,
                    'placeholder' => 'flete puerto?',
                    'attr'=> array('class' => 'myselect' ),
                    'choice_label'=>'combo',
                    'choice_attr' => function ($val, $key, $index) {            // Mete atributos dentro de la etiqueta Option 
                        return array('data-recomendado' => $val->getPrecioVenta());}
                    )
                );
            }else{
                $builder->add('flete', EntityType::class, array(               //Mete datos del formulario en un Select
                        'required' => false ,
                        'class' => Flete::class,
                        'placeholder' => 'flete puerto?',
                        'attr'=> array('class' => 'myselect' ),
                        'choice_label'=>'combo',
                        'choice_attr' => function ($val, $key, $index) {            // Mete atributos dentro de la etiqueta Option 
                        return array('data-recomendado' => $val->getPrecioVenta());}
                    )
                );
            }
            
            $builder
                /*
                ->add('enYarda', CheckboxType::class,  array('required' => false,
                    'attr'=>array('class'=>"form-control", ))
                )
                ->add('repuestos', CheckboxType::class,  array('required' => false ,
                    'attr'=>array('class'=>"form-control" ))
                )*/
                ->add('precioFlete',
                    MoneyType::class,  array('required' => false , 'currency'=>'USD',  'attr'=>array('class'=>"form-control" , 'placeholder'=>"Precio Flete"))
                )
                ->add('GruaPrecio',
                    MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Grua precio"))
                )
                ->add('precioBL',
                    MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('empty_data' => '15','class'=>"form-control" , 'placeholder'=>"Precio BL"))
                )
                ->add('detalleCompra', DetalleCompraType::class, array('paso'=> $paso, 'sucursal' =>$sucursal))        //Se trae el formulario completo de acuerdo al $paso
                
                ->add('aduana', EntityType::class,  array(
                    'required' => false,
                    'class' => Aduana::class,
                    'placeholder' => 'Aduana destino?',
                    'attr'=> array('class' => 'myselect'),)
                )
                ->add('cantidad', TextType::class, array('required' => false , 
                        'attr'=>array('class'=>"form-control", 'placeholder'=>"SUMA DE LOS PRECIOS, SUMA DE COSTOS"))
                )
                ->add('codigo', PasswordType::class, array('required' => false , 
                        'attr'=>array('class'=>"form-control", 'placeholder'=>"Código de descuento"))
                )
                ->add('enCola', CheckboxType::class,  array('required' => false ,
                    'attr'=>array('class'=>"form-control" , )))
            ;
        }



        if( $paso==30 ){ //formato cuadricula 
            $builder
                ->add('id', IntegerType::class, array('required' => true , 'mapped'=>true,'disabled' => true,
                    'attr'=>array('class'=>"form-control", 'disabled'=> true ))
                )
                ->add('valorFob', MoneyType::class,  array('required' => false , 'currency'=>'',  'attr'=>array('class'=>"form-control" , 
                    'placeholder'=>"FOB"))
                )
                ->add('NPTipoVehiculo', EntityType::class,  array(
                        'required' => false,
                        'class' => TipoVehiculo::class,
                        'placeholder' => 'tipo?',
                        'attr'=> array('class' => 'myselect tipoAuto'),)
                )

                ->add('cilindrage', EntityType::class,  array(
                    'required' => false,
                    'class' => Cilindrage::class,
                    'placeholder' => 'cilindrage?',
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-tipoVehiculo' => $val->getTipoVehiculo()->getId());
                    },
                    'attr'=> array('class' => 'myselect2'),)
                )
                ->add('pkgs', IntegerType::class, array('required' => false , 
                        'attr'=>array('class'=>"form-control", ))
                )

                ->add('detalleCompra', DetalleCompraType::class, ['paso'=>30] 
                ) 

            ;
        }

        if( $paso=='costosconte' ) { //validacion de contenedor
            $builder
            ->add('costoFlete', 
            NumberType::class,  array('required' => false, 'attr'=>array("style" => 'width: 100%', 'step' => '0.1','class'=> 'numerico') ))                    
            ->add('GruaPrecio',
            NumberType::class,  array('required' => false, 'attr'=>array("style" => 'width: 100%', 'step' => '0.1','class'=> 'numerico', 'pattern'=>'^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)(?:[eE][+-]?[0-9]+)?$') ))
            ->add('precioFlete',
            NumberType::class,  array('required' => false,'attr'=>array("style" => 'width: 100%', 'step' => '0.1','class'=> 'numerico', 'pattern'=>'^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)(?:[eE][+-]?[0-9]+)?$') ))
            
            
        /*  ->add('precioBL',
            MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('empty_data' => '15','class'=>"form-control" , 'placeholder'=>"Precio BL")))
        */    
            ;
        }

      
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Envio::class,
            'paso' =>1,
            'flete' => NULL,
            'sucursal' =>NULL,
        ]);
    }
}
