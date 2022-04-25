<?php

namespace App\Form;

use App\Entity\DatosPersona;
use App\Entity\Departamentos;
use App\Entity\EstadoCliente;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\File;

class DatosPersonaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $estado = $options['Bandera'];

        if ($estado== 'empresa') {

            $builder
            ->add('nombre', TextType::class,    array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"del cliente o de la empresa?", 'maxlength' => 100 )))
            ->add('nit', TextType::class, array('required' => true ,'attr'=>array('class'=>"form-control", 'placeholder'=>"1234-123456-123-1", 'pattern' => '\d{4}-\d{6}-\d{3}-\d{1}', 'maxlength' => 17)))
     /**/   ->add('direccion', TextareaType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" ,'value'=>"sd" , 'placeholder'=>"Dirección?", 'maxlength' => 200 )))
            ->add('telefono', TextType::class,          array('required' => false ,'attr'=>array('class'=>'form-control', 'placeholder'=>"tel?", 'maxlength' => 15)))
            ->add('celular', TextType::class,           array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"cel", 'maxlength' => 15 )))
           
            ->add('correo1', EmailType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Correo principal?",'maxlength' => 45 )))
            ->add('correo2', EmailType::class,  array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Correo Opcional?", 'maxlength' => 45 )))
           
            //->add('estado', IntegerType::class,  array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Para clientes problematicos poner 0" )))
            ->add('giro',  TextareaType::class, array('required'=> false,'attr'=>array('class'=>'form-control', 'placeholder'=>"giro", 'maxlength' => 400 )))
            ->add('ncr', TextType::class,       array('required'=> false,'attr'=>array('class'=>'form-control', 'placeholder'=>"NRC casos especiales", 'maxlength' => 15)))
            
            ->add('registroIva', TextType::class, array( 'required'=> true,
                'attr'=>array( 'class'=> 'form-control', 'placeholder'=>"Numero Reg.?",'maxlength' => 15)
            ))
            ->add('nombreIva', TextType::class, array( 'required'=> true,
                'attr'=>array( 'class'=> 'form-control', 'placeholder'=>"Nombre en el registro?", 'maxlength' => 35)
            ));
            $builder->add('file',  FileType::class , [
                'label' => 'Seleccione un archivo de word o pdf con sus documentos',
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
                            'application/jpg',
                            'application/jpeg',
                        ],
                        'mimeTypesMessage' => 'Tipo de archivo inválido',
                    ])
                ],
            ]);
            $builder->add('file1',  FileType::class , [
                'label' => 'Seleccione un archivo de word o pdf con sus documentos',
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
                            'application/jpg',
                            'application/jpeg',

                        ],
                        'mimeTypesMessage' => 'Tipo de archivo inválido',
                    ])
                ],
            ]);
         
            $builder->add('logo',  FileType::class , [
                'label' => 'Seleccione una imagen que represente la empresa',
                'attr'=>array('class'=>'form-control'),
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10024k',
                        'mimeTypes' => [                            
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/bmp',
                        ],
                        'mimeTypesMessage' => 'Tipo de archivo inválido',
                    ])
                ],
            ]);

        } else {   
        $builder
            ->add('nombre', TextType::class,    array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"del cliente o de la empresa?", 'maxlength' => 100 )))
            ->add('dui', TextType::class, array('required' => true , 'attr'=>array('class'=>"form-control", 'placeholder'=>"12345678-1", 'maxlength' => 20 )))
            ->add('nit', TextType::class, array('required' => false ,'attr'=>array('class'=>"form-control", 'placeholder'=>"1234-123456-123-1", 'pattern' => '\d{4}-\d{6}-\d{3}-\d{1}', 'maxlength' => 17)))
     /**/   ->add('direccion', TextareaType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" ,'value'=>"sd" , 'placeholder'=>"Dirección?", 'maxlength' => 200 )))
            ->add('telefono', TextType::class,          array('required' => false ,'attr'=>array('class'=>'form-control', 'placeholder'=>"tel?", 'maxlength' => 15)))
            ->add('celular', TextType::class,           array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"cel", 'maxlength' => 15 )))
            ->add('fechaNacimiento', DateType::class,  [
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
                ]
            )
            ->add('correo1', EmailType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Correo principal?",'maxlength' => 45 )))
            ->add('correo2', EmailType::class,  array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Correo Opcional?", 'maxlength' => 45 )))
            ->add('apellido', TextType::class, array('required'=> true, 'attr'=>array('class'=>"form-control", 'placeholder'=>'Apellido', 'maxlength' => 35)))
            //->add('estado', IntegerType::class,  array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Para clientes problematicos poner 0" )))
            ->add('pasaporte', TextType::class, array( 'required'=> false, 'attr'=>array('class'=>'form-control', 'placeholder'=>"pasaporte", 'maxlength' => 15)))
            ->add('giro',  TextareaType::class, array('required'=> false,'attr'=>array('class'=>'form-control', 'placeholder'=>"giro", 'maxlength' => 400 )))
            ->add('ncr', TextType::class,       array('required'=> false,'attr'=>array('class'=>'form-control', 'placeholder'=>"NRC casos especiales", 'maxlength' => 15)))
            ->add('departamento', EntityType::class,  array('required'=> true,'class' => Departamentos::class,
            'placeholder' => 'departamento?','choice_label'=>'nombre','attr'=> array('class' => 'myselect'))
            )

            ->add('registroIva', TextType::class, array( 'required'=> false,
                'attr'=>array( 'class'=> 'form-control', 'placeholder'=>"Numero Reg.?",'maxlength' => 15)
            ))
            ->add('nombreIva', TextType::class, array( 'required'=> false,
                'attr'=>array( 'class'=> 'form-control', 'placeholder'=>"Nombre en el registro?", 'maxlength' => 35)
            ));
            $builder->add('file',  FileType::class , [
                'label' => 'Seleccione un archivo de word o pdf con sus documentos',
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
                            'application/jpg',
                            'application/jpeg',
                        ],
                        'mimeTypesMessage' => 'Tipo de archivo inválido',
                    ])
                ],
            ]);
            $builder->add('file1',  FileType::class , [
                'label' => 'Seleccione un archivo de word o pdf con sus documentos',
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
                            'application/jpg',
                            'application/jpeg',

                        ],
                        'mimeTypesMessage' => 'Tipo de archivo inválido',
                    ])
                ],
            ]);
            $builder->add('file2',  FileType::class , [
                'label' => 'Seleccione un archivo de word o pdf con sus documentos',
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
                            'application/jpg',
                            'application/jpeg',
                        ],
                        'mimeTypesMessage' => 'Tipo de archivo inválido',
                    ])
                ],
            ]) ;           

    } 
/*
     $builder
            ->add('nombre', TextType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"del cliente o de la empresa?", 'pattern' => '[A-Za-z]{4-16} [A-Za-z]{4-16}' )))
            ->add('dui', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"DUI", 'pattern' => '\d{8}-\d{1}')))
            ->add('nit', TextType::class, array('attr'=>array('class'=>"form-control", 'placeholder'=>"NIT", 'pattern' => '\d{4}-\d{6}-\d{3}-\d{1}')))
            ->add('direccion', TextareaType::class,  array('attr'=>array('class'=>"form-control" , 'placeholder'=>"Dirección?",  )))
            ->add('telefono', TextType::class, array('required' => false ,'attr'=>array('class'=>'form-control', 'placeholder'=>"ejem: 5032**...")))
            ->add('celular', TextType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"ejem: 5037**..." )))
            ->add('fechaNacimiento',  DateType::class,  array('required' => false , 'attr'=>array('class'=>"form-control" )))
            ->add('correo1', EmailType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Correo principal?", 'pattern'=>"[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" )))
            ->add('correo2', EmailType::class,  array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Correo Opcional?", 'pattern'=>"[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" )))
            ->add('apellido', TextType::class, array('required'=> false, 'attr'=>array('class'=>"form-control", 'placeholder'=>'Apellido','pattern' => '[A-Za-z]{4-16} [A-Za-z]{4-16}')))
            //->add('estado', IntegerType::class,  array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Para clientes problematicos poner 0" )))
            ->add('pasaporte', TextType::class, array( 'required'=> false, 'attr'=>array('class'=>'form-control', 'placeholder'=>"pasaporte")))
            ->add('giro',  TextareaType::class, array('required'=> false,'attr'=>array('class'=>'form-control', 'placeholder'=>"giro")))
            ->add('ncr', TextType::class, array('required'=> false,'attr'=>array('class'=>'form-control', 'placeholder'=>"NRC casos especiales")))
            ->add('departamento', EntityType::class,  array('class' => Departamentos::class,
            'placeholder' => 'departamento?',
            'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'form-control'))
            )
            ->add('registroIva', TextType::class, array(
                'attr'=>array('required'=> false, 'class'=> 'form-control', 'placeholder'=>"Numero Reg.?")
            ))
            ->add('nombreIva', TextType::class, array('required'=> false,
                'attr'=>array( 'class'=> 'form-control', 'placeholder'=>"Nombre en el registro?")
            ));
            $builder->add('file',  FileType::class , [
                'label' => 'Seleccione un archivo de word o pdf con sus documentos',
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
                            'application/msword'
                        ],
                        'mimeTypesMessage' => 'Tipo de archivo inválido',
                    ])
                ],
            ])
            //->add('personaCliente')
        ;

*/




    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DatosPersona::class,
            'Bandera' => '',
        ]);
    }
}
