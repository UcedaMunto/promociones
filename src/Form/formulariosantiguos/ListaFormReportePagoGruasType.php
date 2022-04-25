<?php

namespace App\Form;

use App\Entity\PreFactGruaUsa;
use App\Repository\PreFactGruaUsaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListaFormReportePagoGruasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder
        ->add('preFactGruaUsa', EntityType::class,  array('class' => PreFactGruaUsa::class,
                'placeholder' => 'Reporte', 
                'query_builder' => function (PreFactGruaUsaRepository $er){
                    return $er->createQueryBuilder('a')
                    ->andWhere('a.creacion > :meses')
                    ->setParameter('meses', new \DateTime(date("Y/m/d",strtotime( date("Y/m/d")."- 6 MONTH"))))
                    ->orderBy('a.id', 'DESC');
                },
                'choice_label'=>'nombre',
                'required' => false,
                'attr'=> array('class' => 'myselect')))
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
