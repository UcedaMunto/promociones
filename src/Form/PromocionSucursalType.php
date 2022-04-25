<?php

namespace App\Form;
 
use App\Entity\PromocionSucursal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PromoSucursal;
use App\Repository\PromoSucursalRepository;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PromocionSucursalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activo', CheckboxType::class, array(
                'required'=>false,
                'label'=>'activada en la sucursal?',
                'attr'=>array('class'=>"form-control" ,)
            ))
            ->add('idSucursalTemp', EntityType::class,  array(
                'required' => false,
                'class' => PromoSucursal::class,
                'query_builder' => function (PromoSucursalRepository $er){
                    return $er->createQueryBuilder('a')
                    ->andWhere('a.activo = true')
                    ->orderBy('a.id', 'ASC');
                },
                'placeholder' => 'seleccione...',
                'mapped'=>true,
                'multiple'=>true,
                'attr'=> array('class' => 'myselect2'))
            )
            ->add('idPromocion',  PromoPromocionesType::class, array( ) )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PromocionSucursal::class,
        ]);
    }
}
