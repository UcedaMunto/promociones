<?php

namespace App\Form;

use App\Entity\Acuerdo;
use App\Entity\DepartamentoAcuerdoEjecucion;
use App\Entity\DepartamentoEmpresa;
use App\Entity\Departamentos;
use App\Entity\DiscusionJefatura;
use App\Entity\UsuarioEmpleado;
use App\Repository\DiscusionJefaturaRepository;
use App\Repository\UsuarioEmpleadoRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AcuerdoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $respuestas = $options['acuerdo_formulario'];
        if($respuestas==0){
            $builder
                ->add('nombre', TextareaType::class,  array(
                    'required' => true, 
                    'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"Titlo de acuerdo",
                    'maxlength' => 35))
                )
                ->add('descripcion', TextareaType::class,  
                    array('required' => true, 
                    'attr'=>array('class'=>"form-control" , 
                    'placeholder'=>"Descripción del acuerdo",
                    'maxlength' => 250)))
                ->add('fechaVigencia' ,  DateType::class,  [ 
                    'required' => true,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"off"], ]
                )
                //->add('estado')
                ->add('supervisor', EntityType::class,  array(
                        'required' => true,
                        'class' => UsuarioEmpleado::class,
                        'placeholder' => 'Seleccione al supervisor',
                        'attr'=> array('class' => 'myselect'),)
                )
                ->add('departamentEmpresa',EntityType::class,  array(
                        'multiple'=> true,
                        'required' => true,
                        'class' => DepartamentoEmpresa::class,
                        'placeholder' => 'Selecione los departamentos',
                        'attr'=> array('class' => 'myselect'),)
                )
                ->add('discusionJefatura',EntityType::class,  array(
                    'required' => true,
                    'class' => DiscusionJefatura::class,
                    'placeholder' => 'Selecione la discusion',
                    'attr'=> array('class' => 'myselect'),
                    'query_builder' => function(DiscusionJefaturaRepository $er ){
                        return $er->createQueryBuilder('a')
                        ->andWhere('a.estado = 1  or a.estado = 2  ')
                        ->orderBy('a.id', 'DESC')
                        ->addOrderBy('a.id', 'DESC')
                        ;},
                ))
            ;
        }else{
            $builder
            ->add('nombre', TextareaType::class,  array('required' => true, 'attr'=>array('class'=>"form-control" , 
            'placeholder'=>"Titlo de acuerdo", 'maxlength' => 35))
            )
            ->add('descripcion', TextareaType::class,  array('required' => true, 'attr'=>array('class'=>"form-control" , 
            'placeholder'=>"Descripción del acuerdo", 'maxlength' => 250)))
            ->add('fechaVigencia' ,  DateType::class,  [ 
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', "autocomplete"=>"on"], 
            ]
            )
            //->add('estado')
            ->add('supervisor', EntityType::class,  array(
                    'required' => true,
                    'class' => UsuarioEmpleado::class,
                    'placeholder' => 'Seleccione al supervisor',
                    'attr'=> array('class' => 'myselect'),
                    /*'query_builder' => function(UsuarioEmpleadoRepository $er ){
                        return $er->createQueryBuilder('a')
                        ->andWhere('a.estado = 1  ')
                        
        
                    },*/ // Que no aparescan usuariooas bloqueados
                    
                )
            )
            ->add('departamentEmpresa',EntityType::class,  array(
                'multiple'=> true,
                'required' => false,
                'class' => DepartamentoEmpresa::class,
                'placeholder' => 'Selecione los departamentos',
                'attr'=> array('class' => 'myselect'),
                )
            )
            ->add('discusionJefatura',EntityType::class,  array(
                'required' => false,
                'class' => DiscusionJefatura::class,
                'placeholder' => 'Selecione la discusion',
                'attr'=> array('class' => 'myselect'),
                'query_builder' => function(DiscusionJefaturaRepository $er ){
                    return $er->createQueryBuilder('a')
                    ->andWhere('a.estado = 1  or a.estado = 2  ')
                    ->orderBy('a.id', 'DESC')
                    ->addOrderBy('a.id', 'DESC')
                ;
    
                },
            ))
        ;

        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Acuerdo::class,
            'acuerdo_formulario' => 0,
            
        ]);
    }
}
