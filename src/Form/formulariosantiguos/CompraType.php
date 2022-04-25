<?php

namespace App\Form;

use App\Entity\Compra;
use App\Entity\Dealer;
use App\Entity\Importador;
use App\Entity\PersonaCliente;
use App\Entity\TipoCompra;
use App\Entity\TipoTitulo;
use App\Repository\ImportadorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;


class CompraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $paso = $options['paso'];
        if($paso == 1 ){
            $builder
                ->add('importador', EntityType::class,  array(
                        'class' => Importador::class,
                        /*'query_builder' => function (ImportadorRepository $er){
                            return $er->importadoresValidosCombo();
                        },*/
                        'choice_attr' => function ($val, $key, $index) {
                            return array( $val->getDisable()=> '',  );
                        },
                        'placeholder' => 'de quien es la cuenta', 
                        'required' => false,'attr'=> array('class' => 'myselect' ,'autocomplete' => 'off'),
                    ))
                ->add('personaCliente', EntityType::class,  array('class' => PersonaCliente::class,
                    'placeholder' => 'Cliente?',
                    'choice_label'=>'dataCombobox',
                    'choice_attr' => function ($val, $key, $index) {
                        return array( $val->getDisable()=> '',  );
                    },
                    'required' => false,'attr'=> array('class' => 'myselect','autocomplete' => 'off'))
                    )
                ->add('tipoCompra', EntityType::class,  array('class' => TipoCompra::class,
                    'placeholder' => 'Tipo de compra?', 
                    'required' => true,'attr'=> array('class' => 'myselect','autocomplete' => 'off'))
                )

                ->add('fechaFacturaCero',  DateType::class,  [ 
                        'required' => false,
                        'widget' => 'single_text',
                        'html5' => false,
                        'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
                    ]
                )
                ->add('facturas',FileType::class, [
                    'label' => 'Seleccione un archivo pdf ',
                    'attr'=>array('class'=>'form-control','autocomplete' => 'off',),
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '10024k',
                            'mimeTypes' => [
                                'application/pdf',
                                'application/x-pdf',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/msword',
                                'image/*',
                            ],
                            'mimeTypesMessage' => 'Tipo de archivo inválido',
                        ])
                    ],
                ])
                ->add('notas', TextareaType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Notas",'autocomplete' => 'off', 'maxlength' => 255 )))
                ->add('copiaEmail', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Copia e-mail",'autocomplete' => 'off', 'maxlength' => 35)))
                ->add('copiaEmail2', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Copia e-mail 2",'autocomplete' => 'off', 'maxlength' => 40)))
                ->add('tipoTitulo', EntityType::class,  array('class' => TipoTitulo::class,
                    'placeholder' => 'Tipo de título?', 
                    'required' => false,'attr'=> array('class' => 'myselect','autocomplete' => 'off'))
                )
                ->add('dealer', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre según factura dealer",'autocomplete' => 'off', 'maxlength' => 50 )))
            ;
        }

        if(($paso <= 5 && $paso>1) || $paso==21){ //EN FORMA READ ONLY NO PERMITE GUARDAR
            $builder
                ->add('importador', EntityType::class,  array(
                    'class' => Importador::class,
                    /*'query_builder' => function (ImportadorRepository $er){
                        return $er->importadoresValidosCombo();
                    },*/
                    'required'=>false,
                    'choice_attr' => function ($val, $key, $index) {
                        return array( $val->getDisable()=> '',  );
                    },
                    'placeholder' => 'de quien es la cuenta',
                    'attr'=> array('class' => 'myselect' ,'autocomplete' => 'off', 'read_only' => true),
                ))
                ->add('personaCliente', EntityType::class,  array( 'class' => PersonaCliente::class,
                    'placeholder' => 'Cliente?',
                    'choice_label'=>'dataCombobox',
                    'required' => false,'attr'=> array('class' => 'myselect', 'read_only' => true))
                )
                /*->add('tipoCompra', EntityType::class,  array('class' => TipoCompra::class,
                    'placeholder' => 'Tipo de compra?', 
                    'required' => true, 'attr'=> array('class' => 'myselect', 'read_only' => true ,'autocomplete' => 'off'))
                )*/
                ->add('fechaFacturaCero',  DateType::class,  [
                        'required' => false,
                        'widget' => 'single_text',
                        'html5' => false,
                        'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
                    ]
                )
                ->add('facturas',FileType::class, [ 'label' => 'Seleccione un archivo pdf ', 
                    'attr'=>array('class'=>'form-control'),  'mapped' => false, 'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '10024k', 'mimeTypes' => [
                                'application/pdf',
                                'application/x-pdf',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/msword',
                                'image/*',
                            ],
                            'mimeTypesMessage' => 'Tipo de archivo inválido',
                        ])
                    ],
                ])
                ->add('notas', TextareaType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Notas",'autocomplete' => 'off', 'maxlength' => 255)))
                ->add('copiaEmail', TextType::class, array('required' => false ,  'disabled'=>true,'attr'=>array('class'=>"form-control", 'placeholder'=>"Copia e-mail",'autocomplete' => 'off', 'maxlength' => 35)))
                ->add('copiaEmail2', TextType::class, array('required' => false, 'attr'=>array('class'=>"form-control", 'placeholder'=>"Copia e-mail 2",'autocomplete' => 'off', 'maxlength' => 40)))
                ->add('tipoTitulo', EntityType::class,  array( 'class' => TipoTitulo::class,
                    'placeholder' => 'Tipo de título?',
                    'required' => false, 
                    'attr'=> array('class' => 'myselect'))
                )
                ->add('dealer', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre según factura dealer",'autocomplete' => 'off', 'maxlength' => 50)))
            ;
        }

        if($paso < 7 && $paso>5){
            $builder
                ->add('fechaFacturaCero',  DateType::class,  [ 
                        'required' => false,
                        'widget' => 'single_text',
                        'html5' => false,
                        'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off','autocomplete' => 'off'],
                    ]
                )
                ->add('facturas',FileType::class, [
                    'label' => 'Seleccione un archivo pdf ',
                    'attr'=>array('class'=>'form-control'),
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '10024k',
                            'mimeTypes' => [
                                'application/pdf',
                                'application/x-pdf',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/msword',
                                'image/*',
                            ],
                            'mimeTypesMessage' => 'Tipo de archivo inválido',
                        ])
                    ],
                ])
                ->add('notas', TextareaType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Notas",'autocomplete' => 'off', 'maxlength' => 255)))
                ->add('copiaEmail', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Copia e-mail",'autocomplete' => 'off', 'maxlength' => 35)))
                ->add('copiaEmail2', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Copia e-mail 2", 'maxlength' => 40)))
                ->add('importador', EntityType::class,  array(
                    'class' => Importador::class,
                    'query_builder' => function (ImportadorRepository $er){
                        return $er->importadoresValidosCombo();
                    },
                    'placeholder' => 'de quien es la cuenta', 
                    'required' => false,'attr'=> array('class' => 'myselect','autocomplete' => 'off'),
                ))
                ->add('personaCliente', EntityType::class,  array('class' => PersonaCliente::class,
                'placeholder' => 'Cliente?',
                'choice_label'=>'cliente',
                'required' => false,'attr'=> array('class' => 'myselect','autocomplete' => 'off'))
                )
                ->add('tipoTitulo', EntityType::class,  array('class' => TipoTitulo::class,
                    'placeholder' => 'Tipo de título?', 
                    'required' => false,'attr'=> array('class' => 'myselect'))
                )
                ->add('dealer', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre según factura dealer",'autocomplete' => 'off', 'maxlength' => 50)))
            ;
        }
        
        if($paso > 6 && $paso<=13){
            $builder
                ->add('fechaFacturaCero',  DateType::class,  [ 
                        'required' => false,
                        'widget' => 'single_text',
                        'html5' => false,
                        'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off','autocomplete' => 'off'],
                    ]
                )
                ->add('facturas',FileType::class, [
                    'label' => 'Seleccione un archivo pdf ',
                    'attr'=>array('class'=>'form-control'),
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '10024k',
                            'mimeTypes' => [
                                'application/pdf',
                                'application/x-pdf',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/msword',
                                'image/*',
                            ],
                            'mimeTypesMessage' => 'Tipo de archivo inválido',
                        ])
                    ],
                ])
                ->add('notas', TextareaType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Notas",'autocomplete' => 'off', 'maxlength' => 255)))
                ->add('copiaEmail', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Copia e-mail",'autocomplete' => 'off', 'maxlength' => 35)))
                ->add('copiaEmail2', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Copia e-mail 2", 'maxlength' => 40)))
                ->add('importador', EntityType::class,  array(
                    'class' => Importador::class,
                    'query_builder' => function (ImportadorRepository $er){
                        return $er->importadoresValidosCombo();
                    },
                    'placeholder' => 'de quien es la cuenta', 
                    'required' => false,'attr'=> array('class' => 'myselect','autocomplete' => 'off'),
                ))
                ->add('personaCliente', EntityType::class,  array('class' => PersonaCliente::class,
                    'placeholder' => 'Cliente?',
                    'choice_label'=>'cliente',
                    'required' => false,'attr'=> array('class' => 'myselect','autocomplete' => 'off'))
                )
                ->add('tipoTitulo', EntityType::class,  array('class' => TipoTitulo::class,
                    'placeholder' => 'Tipo de título?', 
                    'required' => false,'attr'=> array('class' => 'myselect'))
                )
                ->add('dealer', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Nombre según factura dealer",'autocomplete' => 'off', 'maxlength' => 50)))
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Compra::class,
            'paso' =>1,
        ]);
    }
}
