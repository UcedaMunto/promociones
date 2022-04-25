<?php

namespace App\Form;

use App\Entity\DetalleCompra;
use App\Entity\Marca;
use App\Entity\Modelo;
use App\Entity\ZonaGrua;
use App\Repository\DetalleCompraRepository;
use App\Repository\ModeloRepository;
use App\Repository\ZonaGruaRepository;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetalleCompraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $paso = $options['paso'];
        $sucursal=  $options['sucursal'];
        if($paso == 1 ){ //PASO 1 DE TRACKING
            $builder
                ->add('lote', TextType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"lote", 'pattern' => '^[A-Za-z0-9]{8}', 'maxlength' => 8  )))
                ->add('titulo', ChoiceType::class, [
                    'required' => true,
                    'choices'  => [
                        'seleccione'=> null,
                        'si' => 1,
                        'no' => 2,
                        'pendiente' => 3,
                    ],
                    'attr'=>array('class'=>"form-control", 'placeholder'=>"Titulo")
                ])
                ->add('llave', ChoiceType::class, [
                    'required' => true,
                    'choices'  => [
                        'seleccione'=> null,
                        'no' => 2,
                        'si' => 1,
                        'pendiente' => 3,
                    ],
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"Llave?")
                ])
                ->add('anio', IntegerType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Año - XXXX ", 'min'=>"2013"))
                )
                ->add('vin', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"Vin", 'pattern' => '^[A-Za-z0-9]{17}', 'maxlength' => 17)))
                //->add('subModelo', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"sub modelo", )))
                ->add('direccionParticular', TextType::class,  array('required' => false , 
                    'attr'=>array('class'=>"form-control" , 'autocomplete' => 'off', 'placeholder'=>"Dirección particular del vehículo", 'maxlength' => 250 )))
                ->add('vehiculoDescripcion', TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"descripción de vehículo", 'maxlength' => 255)))
                ->add('grua', CheckboxType::class,  array( 'required' => false ,
                    'attr'=>array('class'=>"form-control" ,'autocomplete' => 'off', 'placeholder'=>"Grua", )))
                ->add('compra', CompraType::class, ['paso' =>1,] )
                ->add('modelo', EntityType::class,  array(
                    'class' => Modelo::class,
                    'query_builder' => function (ModeloRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.nombre', 'ASC');
                    },
                    'placeholder' => 'Seleccione modelo', 
                    'required' => true,
                        'attr'=> array('autocomplete' => 'off','class' => 'myselect'))
                )
                ->add('zonaSucursal', EntityType::class,  array(               //Mete datos del formulario en un Select
                    'required' => false ,
                    'class' => ZonaGrua::class,
                    'placeholder' => 'Sucursal de la subasta?',
                    'attr'=> array('class' => 'myselect', 'autocomplete' => 'off',),
                    'query_builder' => function (ZonaGruaRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.precio', 'DESC');
                    },
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-precio' => $val->getPrecio());
                    })
                )
            ;
        }

        if(($paso <=5 && $paso>1)  || $paso==21){ //--------------- FOTOS DE GRUA O YARDA Antes del dockreceipt 
            if( $sucursal == NULL){ //Sucursal solo puede ser ingresado una vez la bandera sucursal dice si se ha seleccionado en algún momento
                $builder->add('zonaSucursal', EntityType::class,  array(               //Mete datos del formulario en un Select
                    'required' => false ,
                    'class' => ZonaGrua::class,
                    'placeholder' => 'Sucursal de la subasta?',
                    'attr'=> array('class' => 'myselect', 'autocomplete' => 'off',),
                    'query_builder' => function (ZonaGruaRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.precio', 'DESC');
                    },
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-precio' => $val->getPrecio());
                    })
                );
            }else{
                $builder->add('zonaSucursal', EntityType::class,  array(               //Mete datos del formulario en un Select
                    'required' => false ,
                    'class' => ZonaGrua::class,
                    'placeholder' => 'Sucursal de la subasta?',
                    'attr'=> array('class' => 'myselect', 'autocomplete' => 'off', ),
                    'query_builder' => function (ZonaGruaRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.precio', 'DESC');
                    },
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-precio' => $val->getPrecio());
                    })
                );
            }
            
            $builder
                ->add('lote', TextType::class, array('required' => true , 
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"lote", 'pattern' => '^[A-Za-z0-9]{8}', 'maxlength' => 8))
                )
                ->add('titulo', ChoiceType::class, [
                    'required' => true,
                    'choices'  => [
                        'seleccione'=> null,
                        'si' => 1,
                        'no' => 2,
                        'pendiente' => 3,
                    ],
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"Titulo")]
                )
                ->add('llave', ChoiceType::class, [
                    'required' => true,
                    'choices'  => [
                        'seleccione'=> null,
                        'no' => 2,
                        'si' => 1,
                        'pendiente' => 3,
                    ],
                    'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Llave?")]
                )
                ->add('anio', IntegerType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Año - XXXX ", 'min'=>"2013"))
                )
                
                ->add('vin', TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"Vin", 'pattern' => '^[A-Za-z0-9]{17}', 'maxlength' => 17))
                )
                ->add('direccionParticular', TextType::class,  array('required' => false , 
                    'attr'=>array('class'=>"form-control" ,'autocomplete' => 'off', 'placeholder'=>"Dirección particular del vehículo", 'maxlength' => 250 ))
                )
                ->add('vehiculoDescripcion', TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"descripción de vehículo", 'maxlength' => 255))
                )
                
                ->add('compra', CompraType::class, array('paso'=> $paso))
                ->add('modelo', EntityType::class,  array(
                    'class' => Modelo::class,
                    'query_builder' => function (ModeloRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.nombre', 'ASC');
                    },
                    'placeholder' => 'modelo?', 
                    'required' => true,'attr'=> array('autocomplete' => 'off','class' => 'myselect'))
                );
        }

        if(($paso <=13 && $paso>5)  || $paso==21){ //--------------- FOTOS DE GRUA O YARDA Antes del dockreceipt 
            if( $sucursal == NULL){ //Sucursal solo puede ser ingresado una vez la bandera sucursal dice si se ha seleccionado en algún momento
                $builder->add('zonaSucursal', EntityType::class,  array(               //Mete datos del formulario en un Select
                    'required' => false ,
                    'class' => ZonaGrua::class,
                    'placeholder' => 'Sucursal de la subasta?',
                    'attr'=> array('class' => 'myselect', 'autocomplete' => 'off',),
                    'query_builder' => function (ZonaGruaRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.precio', 'DESC');
                    },
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-precio' => $val->getPrecio());
                    })
                );
            }else{
                $builder->add('zonaSucursal', EntityType::class,  array(               //Mete datos del formulario en un Select
                    'required' => false ,
                    'class' => ZonaGrua::class,
                    'placeholder' => 'Sucursal de la subasta?',
                    'attr'=> array('class' => 'myselect', 'autocomplete' => 'off', ),
                    'query_builder' => function (ZonaGruaRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.precio', 'DESC');
                    },
                    'choice_attr' => function ($val, $key, $index) {
                        return array('data-precio' => $val->getPrecio());
                    })
                );
            }
            
            $builder
                ->add('lote', TextType::class, array('required' => true , 
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"lote", 'pattern' => '^[A-Za-z0-9]{8}', 'maxlength' => 8))
                )
                ->add('titulo', ChoiceType::class, [
                    'required' => true,
                    'choices'  => [
                        'seleccione'=> null,
                        'si' => 1,
                        'no' => 2,
                        'pendiente' => 3,
                    ],
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"Titulo")]
                )
                ->add('llave', ChoiceType::class, [
                    'required' => true,
                    'choices'  => [
                        'seleccione'=> null,
                        'no' => 2,
                        'si' => 1,
                        'pendiente' => 3,
                    ],
                    'attr'=>array('class'=>"form-control", 'autocomplete' => 'off', 'placeholder'=>"Llave?")]
                )
                ->add('anio', IntegerType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Año - XXXX ", 'min'=>"2013"))
                )
                
                ->add('vin', TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"Vin", 
                    'pattern' => '^[A-Za-z0-9]{17}', 'maxlength' => 17))
                )
                ->add('direccionParticular', TextType::class,  array('required' => false , 
                    'attr'=>array('class'=>"form-control" ,'autocomplete' => 'off', 'placeholder'=>"Dirección particular del vehículo", 'maxlength' => 250 ))
                )
                ->add('vehiculoDescripcion', TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control",'autocomplete' => 'off', 'placeholder'=>"descripción de vehículo", 'maxlength' => 255))
                )
                
                ->add('compra', CompraType::class, array('paso'=> $paso))
                ->add('modelo', EntityType::class,  array(
                    'class' => Modelo::class,
                    'query_builder' => function (ModeloRepository $er){
                        return $er->createQueryBuilder('a')
                        ->orderBy('a.nombre', 'ASC');
                    },
                    'placeholder' => 'modelo?', 
                    'required' => true,'attr'=> array('autocomplete' => 'off','class' => 'myselect'))
                );
        }

        if($paso == 30  ){//Formato para cuadricula 
            $builder
                ->add('lote', TextType::class, array('required' => true , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"lote", 'autocomplete' => 'off',)))
                ->add('pesoKilogramos', NumberType::class, array('required' => true , 'mapped'=>true,
                    'attr'=>array('class'=>"form-control", 'disabled'=> false, 'autocomplete' => 'off',)))
                ->add('pesoLibras', NumberType::class, array('required' => true , 'mapped'=>true, 'disabled' => true,
                    'attr'=>array('class'=>"form-control", 'disabled'=> true,'autocomplete' => 'off', ))
                )
                ->add('comboAuto', TextType::class, array('required' => true , 'mapped'=>true,'disabled' => true,
                    'attr'=>array('class'=>"form-control", 'disabled'=> true, 'read_only' =>true,'autocomplete' => 'off', ))
                );
        }
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetalleCompra::class,
            'paso' =>1,
            'sucursal' =>NULL,
        ]);
    }
}
