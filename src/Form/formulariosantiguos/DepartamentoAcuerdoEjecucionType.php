<?php

namespace App\Form;

use App\Entity\Acuerdo;
use App\Entity\DepartamentoAcuerdoEjecucion;
use App\Entity\DepartamentoEmpresa;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartamentoAcuerdoEjecucionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departamentoEmpresa',EntityType::class,  array(
                'multiple'=>true,
                'required' => true,
                'class' => DepartamentoEmpresa::class,
                'placeholder' => 'Selecione departamento',
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('acuerdo', AcuerdoType::class)
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DepartamentoAcuerdoEjecucion::class,
        ]);
    }
}
