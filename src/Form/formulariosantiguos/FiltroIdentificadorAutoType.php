<?php

namespace App\Form;

use App\Entity\Aduana;
use App\Entity\DetalleCompra;
use App\Repository\AduanaRepository;
use App\Repository\DetalleCompraRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltroIdentificadorAutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fechaInicial= new \DateTime(  date("Y/m/d",strtotime( date("Y/m/d")."- 4 month")));
        $fechaFinal= new \DateTime('NOW');
        
        $builder
        ->add('listaAutos',EntityType::class, array(
            'class' => DetalleCompra::class,
            'placeholder' => false,
            'query_builder' => function (DetalleCompraRepository $er)
                use($fechaFinal, $fechaInicial){
                    return $er->createQueryBuilder('a')
                    ->andWhere('a.TrackP1Ingreso >= :fechaInicial')
                    ->andWhere('a.TrackP1Ingreso <= :fechaFinal')
                    ->andWhere('a.TrackP11Cobrado IS NULL')
                    ->setParameter('fechaInicial', $fechaInicial )
                    ->setParameter('fechaFinal',  $fechaFinal )
                    ->orderBy('a.id', 'DESC');
                },
            'placeholder' => 'Search from vin or lote',
            'mapped'=>false,
            'multiple'=>false,
            'required' => false,'choice_label'=>'LoteVin','attr'=> array('class' => 'myselect2', 'width'=>'100%',))
        )
        /*
        ->add('aduana',EntityType::class, array(
            'class' => Aduana::class,
            'placeholder' => false,
            'query_builder' => function (AduanaRepository $er){
                    return $er->createQueryBuilder('a');
                },
            'placeholder' => 'Search from vin or lote',
            'mapped'=>false,
            'multiple'=>false,
            'required' => false,'choice_label'=>'nombre','attr'=> array('class' => 'myselect2'))
        )*/
        ;
       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
