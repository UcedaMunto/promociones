<?php

namespace App\Form;

use App\Entity\Departamentos;
use App\Entity\FacturaCargaGeneral;
use App\Entity\PersonaCliente;
use App\Entity\Puertos;
use App\Entity\States;
use App\Entity\WorkOrder;
use App\Repository\PersonaClienteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FacturaCargaGeneralType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', TextareaType::class,  array(
                'required' => true, 
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"numero factura",
                'maxlength' => 30)))
            ->add('direccionDestino', TextareaType::class,  array(
                'required' => true, 
                'attr'=>array('class'=>"form-control" ,
                'placeholder'=>"direccion destino",
                'maxlength' => 100))
            )
            ->add('puertoOrigen', EntityType::class, array(
                'required' => true,
                'class' => Puertos::class,
                'placeholder' => 'Seleccione el puerto',
                'attr'=> array('class' => 'myselect')
            ))
            ->add('puertoDestino', EntityType::class, array(
                'required' => true,
                'class' => Puertos::class,
                'placeholder' => 'Seleccione el puerto',
                'attr'=> array('class' => 'myselect')
            ))
            ->add('stateOrigen', EntityType::class, array(
                'required' => true,
                'class' => States::class,
                'placeholder' => 'Seleccione el estado',
                'attr'=> array('class' => 'myselect')
            ))
            ->add('workOrder', EntityType::class, array(
                'required' => true,
                'class' => WorkOrder::class,
                'placeholder' => 'Seleccione la orden de trabajo',
                'attr'=> array('class' => 'myselect')
            ))
            ->add('departamentoDestino', EntityType::class, array(
                'required' => true,
                'class' => Departamentos::class,
                'placeholder' => 'Seleccione el departamento',
                'attr'=> array('class' => 'myselect')
            ))
            ->add('personaCliente',EntityType::class, array(
                'required' => false,
                'class' => PersonaCliente::class,
                'placeholder' => 'Selecione ...',
                'attr'=> array('class' => 'myselect'),
                'query_builder' => function(PersonaClienteRepository $er ){
                    return $er->createQueryBuilder('a')
                    ->andWhere('a.tipoCliente = 5 or a.tipoCliente = 6')
                    ;
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FacturaCargaGeneral::class,
        ]);
    }
}
