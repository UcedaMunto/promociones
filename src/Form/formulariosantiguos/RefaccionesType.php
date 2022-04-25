<?php

namespace App\Form;

use App\Entity\DatosPersona;
use App\Entity\Envio;
use App\Entity\Refacciones;
use App\Entity\TipoCompra;
use App\Entity\TipoEmbalage;
use App\Form\DataTransformer\EnvioToNumberTransformer;
use App\Repository\EnvioRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefaccionesType extends AbstractType
{
    private $transformer;

    public function __construct(EnvioToNumberTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $paso = $options['paso'];
        $contenedor = $options['contenedor'];
        if( $paso == 0 ){
            $builder
            ->add('cantidad', IntegerType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Cantidad")))
            ->add('descripcion', TextareaType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Descripcion")))
            ->add('blCosto', MoneyType::class, array('required' => false ,  'currency'=>'','attr'=>array('class'=>"form-control", 'placeholder'=>"BL?")))
            ->add('precio', MoneyType::class, array('required' => false ,  'currency'=>'','attr'=>array('class'=>"form-control", 'placeholder'=>"Precio")))
            ->add('peso', IntegerType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Peso")))
            ->add('numeroFactura', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Num Factura")))
            ->add('tipoEmbalaje', EntityType::class,  array('class' => TipoEmbalage::class,
                'placeholder' => 'Tipo de embalage?',
                'choice_label'=>'nombre',
                'required' => false,'attr'=> array('class' => 'myselect'))
            )
            ->add('autoRecipiente', IntegerType::class, array( 'required' => false ,
                'attr'=>array('readonly' => false, 'class'=>"form-control", 'placeholder'=>"vehículo?")))
            ->add('cliente', EntityType::class,  array('class' => DatosPersona::class,
                'placeholder' => 'Cliente?',
                'choice_label'=>'Cliente',
                'required' => false,'attr'=> array('class' => 'myselect'))
            )
            ;

            $builder->get('autoRecipiente')->addModelTransformer($this->transformer); //esta parte se encarga de transformar un entero a una entidad de tipo envio
        }
        
        if( $paso == 1 ){
            $builder
            ->add('precio', MoneyType::class,  array('required' => false ,  'currency'=>'', 
            'attr'=>array('class'=>"form-control" , 'placeholder'=>"Precio")))
            ->add('costo', MoneyType::class,  array('required' => false ,  'currency'=>'',
            'attr'=>array('class'=>"form-control" , 'placeholder'=>"Costo")))
            ->add('blCosto', MoneyType::class,  array('required' => false , 'currency'=>'',
            'attr'=>array('class'=>"form-control" , 'placeholder'=>"BL")))
            ;
        }

        if( $paso == 3 ){ //CREACION add refaccion
            $builder
            ->add('cantidad', IntegerType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Cantidad")))
            ->add('descripcion', TextareaType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Descripcion")))
            ->add('peso', IntegerType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Peso")))
            ->add('numeroFactura', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Num Factura")))
            ->add('tipoEmbalaje', EntityType::class,  array('class' => TipoEmbalage::class,
                'placeholder' => 'Tipo de embalage?',
                'choice_label'=>'nombre',
                'required' => false,'attr'=> array('class' => 'myselect'))
            )
            ->add('blCosto', MoneyType::class, array('required' => false ,  'currency'=>'','attr'=>array('class'=>"form-control", 'placeholder'=>"BL?")))
            ->add('precio', MoneyType::class, array('required' => false ,  'currency'=>'','attr'=>array('class'=>"form-control", 'placeholder'=>"Precio")))
            ->add('autoRecipiente', EntityType::class,  array(
                'required' => false,
                'class' => Envio::class,
                'query_builder' => function (EnvioRepository $er)use($contenedor){
                    return $er->createQueryBuilder('a')
                    ->leftJoin('a.detalleCompra', 'dc')
                    ->leftJoin('a.envioContedor', 'ec')
                    ->andWhere('ec.contenedor= :contenedor')
                    ->setParameter('contenedor', $contenedor)
                    ->orderBy('a.id', 'ASC');
                },
                'placeholder' => 'auto?',
                'mapped'=>true,
                'multiple'=>false,
                'choice_label'=>'comboAuto',
                'attr'=> array('class' => 'myselect2'))
            )
            ->add('cliente', EntityType::class,  array('class' => DatosPersona::class,
                'placeholder' => 'Cliente?',
                'choice_label'=>'Cliente',
                'required' => true,'attr'=> array('class' => 'myselect'))
            )
            ;
            
        }

        
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Refacciones::class,
            'paso' => 0,
            'contenedor'=>0
        ]);
    }
}
