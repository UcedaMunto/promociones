<?php

namespace App\Form;

use App\Entity\GrupoMovimientos;
use App\Entity\Movimiento;
use App\Entity\PreFactGruaUsa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreFactGruaUsaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('movimientos', CollectionType::class,[
                    'entry_type' => MovimientoType::class,'allow_delete' => false,
                    'entry_options' => ['label' => false, 'tipo' => 'preFactGrua',  ],
                ]
            )
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => GrupoMovimientos::class,
                'allow_extra_fields' =>true,
            )
        );
    }
}
