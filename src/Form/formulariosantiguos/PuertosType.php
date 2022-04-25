<?php

namespace App\Form;

use App\Entity\Cities;
use App\Entity\Departamentos;
use App\Entity\Puertos;
use App\Entity\TipoPuerto;
use App\Repository\TipoPuertoRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PuertosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $respuestas = $options['formularioTipo'];
        if($respuestas==0){
            $builder
            ->add('nombre', TextareaType::class, array(
                'required' => true, 
                'label' => "Nombre del puerto",
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"Nombre",
                'maxlength' => 35,
            )))
            ->add('tiposUsos',EntityType::class, array(
                'required' => false,
                'mapped' => false,
                'multiple' =>true,
                'class' => TipoPuerto::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
                'query_builder' => function(TipoPuertoRepository $er ){
                    return $er->createQueryBuilder('a');
                }
            ))

            ->add('tipoPuerto', ChoiceType::class, [
                'required' => false,
                'placeholder'=>"Seleccione ubicacion ",
                'choices' => [

                    'Puerto de Estados unidos' => 0,
                    'Puertos de Centro america' => 1,
                ],
                'attr'=>array('class'=>"form-control",'autocomplete' => 'off' )      ]      
            
            )

            ->add('ciudad', EntityType::class, array(
                'required' => false,
                'class' => Cities::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
            ) )
            ->add('departamento', EntityType::class, array(
                'required' => false,
                'class' => Departamentos::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
            ))
            ;

        }else{
            $builder
            ->add('nombre', TextareaType::class, array(
                'required' => true, 
                'label' => "Nombre del puerto",
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"Nombre",
                'maxlength' => 35,
            )))
            ->add('tiposUsos',EntityType::class, array(
                'required' => false,
                
                'multiple' =>true,
                'class' => TipoPuerto::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
                'query_builder' => function(TipoPuertoRepository $er ){
                    return $er->createQueryBuilder('a');
                }
            ))

            ->add('tipoPuerto', ChoiceType::class, [
                'required' => false,
                'placeholder'=>"Seleccione ubicacion ",
                'choices' => [

                    'Puerto de Estados unidos' => 0,
                    'Puertos de Centro america' => 1,
                ],
                'attr'=>array('class'=>"form-control",'autocomplete' => 'off' )      ]      
            
            )

            ->add('ciudad', EntityType::class, array(
                'required' => false,
                'class' => Cities::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
            ) )
            ->add('departamento', EntityType::class, array(
                'required' => false,
                'class' => Departamentos::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
            ))
        ;
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Puertos::class,
            'formularioTipo' => 0,
        ]);
    }
}
