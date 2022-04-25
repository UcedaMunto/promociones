<?php

namespace App\Form;

use App\Entity\Cilindrage;
use App\Entity\EnvioContenedor;
use App\Entity\TipoVehiculo;
use phpDocumentor\Reflection\Types\Integer;
use App\Form\DataTransformer\EnvioToNumberTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnvioContenedorType extends AbstractType
{
    private $transformer;

    public function __construct(EnvioToNumberTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tipo=$options['tipo'];
        if( strcmp($tipo, 'cuadricula' )==0 ){
            $builder
                ->add('envio', IntegerType::class, array(
                'attr'=>array('width'=>'70px', false, 'required' => false , 'readonly' => true, 'class'=>"form-control", 'placeholder'=>"id?")))
                ->add('lote', TextType::class, array(  
                'attr'=>array('readonly' => true,'class'=>"form-control", 'placeholder'=>"Lote")))
                ->add('vin', TextType::class, array(
                'attr'=>array( 'readonly' => true,'class'=>"form-control", 'placeholder'=>"vin")))
                ->add('peso', NumberType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control tablaAutosFiltrados", 'placeholder'=>"Peso")))
                ->add('pesoLibras', NumberType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control tablaAutosFiltrados", 'placeholder'=>"libras")))
                ->add('modeloMarca', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control tablaAutosFiltrados", 'placeholder'=>"Sub modelo?")))
                
                ->add('listaTipoVehiculo', EntityType::class,  array('class' => TipoVehiculo::class,
                'placeholder' => 'Tipo vehículo?',
                'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))

                ->add('listaCilindrage', EntityType::class,  array('class' => Cilindrage::class,
                'placeholder' => 'Cilindraje?',
                'required' => true,'choice_label'=>'descripcion','attr'=> array('class' => 'myselect')))
                ->add('pkgs', NumberType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control tablaAutosFiltrados", 'placeholder'=>"pkgs?")))
                ->add('valorFob', MoneyType::class,  array('required' => false , 'currency'=>'',  
                'attr'=>array('class'=>"form-control" , 'placeholder'=>"FOB")))
            ;
        }
        if( strcmp($tipo, 'normal' )==0 ){
            $builder
                ->add('peso', NumberType::class, array('required' => false, 
                'attr'=>array('class'=>"form-control tablaAutosFiltrados", 'placeholder'=>"Peso")))
                ->add('aes', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control tablaAutosFiltrados", 'placeholder'=>"AES")))
                ->add('color', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control tablaAutosFiltrados", 'placeholder'=>"COLOR?")))
                ->add('submodelo', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control tablaAutosFiltrados", 'placeholder'=>"Sub modelo?")))
                ->add('envio', IntegerType::class, array(
                'attr'=>array( 'required' => false , 'readonly' => true, 'class'=>"form-control", 'placeholder'=>"id?")))
                ->add('lote', TextType::class, array(  
                'attr'=>array('readonly' => true,'class'=>"form-control", 'placeholder'=>"Lote")))
                ->add('vin', TextType::class, array(
                'attr'=>array( 'readonly' => true,'class'=>"form-control", 'placeholder'=>"vin")))
                ->add('vehiculo', TextType::class, array(
                'attr'=>array( 'readonly' => true,'class'=>"form-control", 'placeholder'=>"vehiculo")))
            ;
        }


        if ( strcmp($tipo, 'validacioncostos' )==0 )
        {
            $builder
            ->add('envio', EnvioType::class, ['paso'=>'costosconte'])
            ->add('notariaCosto', 
            NumberType::class,  array('required' => false, 'attr'=>array("style" => 'width: 100%', 'step' => '0.1','class'=> 'numerico', 'pattern'=>'^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)(?:[eE][+-]?[0-9]+)?$')  ))
           /* ->add('otrosCostos', 
            IntegerType::class,  array('required' => false,'attr'=>array("style" => 'width: 100%')  )) */
            ->add('notaria', 
            NumberType::class,  array('required' => false,'attr'=>array("style" => 'width: 100%', 'step' => '0.1','class'=> 'numerico', 'pattern'=>'^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)(?:[eE][+-]?[0-9]+)?$')  ))
            ->add('storage', 
            NumberType::class,  array('required' => false,'attr'=>array("style" => 'width: 100%', 'step' => '0.1','class'=> 'numerico', 'pattern'=>'^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)(?:[eE][+-]?[0-9]+)?$')  ))
            ->add('otros', 
            NumberType::class,  array('required' => false,'attr'=>array("style" => 'width: 100%', 'step' => '0.1','class'=> 'numerico', 'pattern'=>'^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)(?:[eE][+-]?[0-9]+)?$')  ))
            ;
        } else 
        {
            $builder->get('envio')->addModelTransformer($this->transformer);
        }      
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EnvioContenedor::class,
            'tipo' => 'normal',
        ]);
    }
}
