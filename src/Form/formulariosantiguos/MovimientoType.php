<?php

namespace App\Form;

use App\Entity\Cheques;
use App\Entity\Cities;
use App\Entity\CompaniasGrua;
use App\Entity\EstadoMovimiento;
use App\Entity\Movimiento;
use App\Entity\PreFactGruaUsa;
use App\Repository\ChequesRepository;
use App\Repository\PreFactGruaUsaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Currency;

class MovimientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['tipo']=='normal' ){
            $builder
                ->add('storage',
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                    'attr'=>array('class'=>"form-control" , 'placeholder'=>"estorage"))
                )
                ->add('otrosCostosGrua',
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                    'attr'=>array('class'=>"form-control" , 'placeholder'=>"otros costos de grua"))
                )

                
                ->add('fechaRecogida',  DateType::class,  [ 
                        'required' => true,
                        'widget' => 'single_text',
                        'html5' => false,
                        'attr' => ['class' => 'datepicker form-control'], 
                    ]
                )
                ->add('fechaContrato',  DateType::class,[
                    'required' => true,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control'], 
                    ]
                )
                ->add('fechaEntrega', DateType::class,[ 
                    'required' => true,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control'],
                    ]
                )
                ->add('estado', EntityType::class,  array('class' => EstadoMovimiento::class,
                'placeholder' => 'Estado?',
                'required' => true,'attr'=> array('class' => 'form-control'))
                )
                ->add('descripcion', 
                    TextareaType::class,  array('required' => false, 'attr'=>array('class'=>"form-control" , 
                    'placeholder'=>"Descripción del movimiento")))
                ->add('ciudadOrigen', EntityType::class,  array('class' => Cities::class,
                'placeholder' => 'Ciudad Origen',
                'choice_label'=>'nombreYEstado',
                'required' => false,'attr'=> array('class' => 'myselect')))
                ->add('ciudadDestino', EntityType::class,  array('class' => Cities::class,
                'placeholder' => 'Ciudad Destino',
                'choice_label'=>'nombreYEstado',
                'required' => false,'attr'=> array('class' => 'myselect')))
                ->add('compania', EntityType::class,  array('class' => CompaniasGrua::class,
                'placeholder' => 'Compañía', 
                'required' => true,'attr'=> array('class' => 'myselect')))
                ->add('grua', 
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                        'attr'=>array('class'=>"form-control" , 'placeholder'=>"costo de grua"))
                )

                ->add('linkCentralDispatch', 
                    TextType::class,  array(
                    'required' => false,
                    'attr'=>array('class'=>"form-control",
                )))
                
                //->add('envio')
            ;
        }

        if($options['tipo']=='preFactGrua')
        {
            $id = $options['id'];
            $builder
                ->add('id', 
                    IntegerType::class,  array(
                    'required' => true, 'label'=>false,
                    'attr'=>array('class'=>"form-control intangible",   
                )))
                ->add('cheques',EntityType::class,  array(
                    'class' => Cheques::class,
                    'placeholder' => 'Los cheques con los que se pagó?',
                    'multiple'=>true,
                    'query_builder' => function(ChequesRepository $er)use($id){
                        return $er->createQueryBuilder('a')
                        ->leftJoin('a.movimientosPagosGrua','movGrua') // si fue seleccionado en la relacion muchos a muchos se debe incluir
                        ->leftJoin('a.movimientosPagosStorage','movStorage') 
                        ->leftJoin('a.movimientosPagosOtros','movPagoOtros') 
                        ->andWhere('a.creacion > :SM or movGrua.id = :id or movStorage.id = :id or movPagoOtros.id = :id')
                        ->setParameter('SM', new \DateTime(date("Y/m/d",strtotime( date("Y/m/d")."- 2 day"))))
                        ->setParameter('id', $id )
                        ->orderBy('a.id', 'DESC');
                    },
                    'required' => false,
                    'attr'=> array('class' => 'myselect', 'width'=>'100%'))
                    )
                ->add('dataEnvio', 
                    TextType::class,  array(
                    'required' => false,
                    'attr'=>array('class'=>"form-control", 'readonly'=>'',
                )))
                ->add('grua', 
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                    'attr'=>array('class'=>"form-control" , 'placeholder'=>"grua"))
                )
                ->add('storage', 
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                        'attr'=>array('class'=>"form-control" , 'placeholder'=>"estorage"))
                )
                ->add('otrosCostosGrua',
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                    'attr'=>array('class'=>"form-control" , 'placeholder'=>"otros costos de grua"))
                )
                
                ->add('fechaEntrega',  DateType::class,  [
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control',],
                        ]
                    )
                ->add('estado', EntityType::class,  array('class' => EstadoMovimiento::class,
                    'placeholder' => 'Estado?',
                    'required' => true,'attr'=> array('class' => 'myselect'))
                )
                ->add('otraDescripcion', 
                    TextareaType::class,  array('required' => false, 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Descripcion")))
                ->add('compania', EntityType::class,  array('class' => CompaniasGrua::class,
                    'placeholder' => 'Compañía', 
                    'required' => false,'attr'=> array('class' => 'myselect')))
                ->add('pagoGrua', CheckboxType::class,  array('required' => false ,
                    'attr'=>array('class'=>"form-control" , )))
                ->add('pagoStorage', CheckboxType::class,  array('required' => false ,
                    'attr'=>array('class'=>"form-control" , )))
                ->add('pagoOtrosCostos', CheckboxType::class,  array('required' => false ,
                    'attr'=>array('class'=>"form-control" , )))
                
            ;
        }

        if($options['tipo']=='Editar' ){
            $builder
                ->add('storage',
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                    'attr'=>array('class'=>"form-control" , 'placeholder'=>"estorage"))
                )
                ->add('otrosCostosGrua',
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                    'attr'=>array('class'=>"form-control" , 'placeholder'=>"otros costos de grua"))
                )

                
                ->add('fechaRecogida',  DateType::class,  [ 
                        'required' => false,
                        'widget' => 'single_text',
                        'html5' => false,
                        'attr' => ['class' => 'datepicker form-control'], 
                    ]
                )
                ->add('fechaContrato',  DateType::class,[
                    'required' => false,
                    'disabled' => true,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control'], 
                    ]
                )
                ->add('fechaEntrega', DateType::class,[ 
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control'],
                    ]
                )
                ->add('estado', EntityType::class,  array('class' => EstadoMovimiento::class,
                'placeholder' => 'Estado?',
                'required' => true,'attr'=> array('class' => 'form-control'))
                )
                ->add('descripcion', 
                    TextareaType::class,  array('required' => false, 'attr'=>array('class'=>"form-control" , 
                    'placeholder'=>"Descripción del movimiento")))
                ->add('ciudadOrigen', EntityType::class,  array('class' => Cities::class,
                'placeholder' => 'Ciudad Origen',
                'choice_label'=>'nombreYEstado',
                'required' => false,'attr'=> array('class' => 'myselect')))
                ->add('ciudadDestino', EntityType::class,  array('class' => Cities::class,
                'placeholder' => 'Ciudad Destino',
                'choice_label'=>'nombreYEstado',
                'required' => false,'attr'=> array('class' => 'myselect')))
                ->add('compania', EntityType::class,  array('class' => CompaniasGrua::class,
                'placeholder' => 'Compañía', 
                'required' => true,'attr'=> array('class' => 'myselect')))
                ->add('grua', 
                    MoneyType::class,  array('required' => false , 'currency'=>'', 
                        'attr'=>array('class'=>"form-control" , 'placeholder'=>"costo de grua"))
                )

                ->add('linkCentralDispatch', 
                    TextType::class,  array(
                    'required' => false,
                    'attr'=>array('class'=>"form-control",
                )))
                
                //->add('envio')
            ;
        }
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'allow_extra_fields' =>true,
            'data_class' => Movimiento::class,
            'tipo'=>'normal',
            'id'=>0,
          
        ]);
    }
}
