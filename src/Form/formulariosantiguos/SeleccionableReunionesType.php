<?php

namespace App\Form;

use App\Entity\DiscusionJefatura;
use App\Repository\DiscusionJefaturaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeleccionableReunionesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('discusionJefatura',EntityType::class,  array(
            'required' => false,
            'class' => DiscusionJefatura::class,
            /*'query_builder' => function(DiscusionJefaturaRepository $er ){
                return $er->createQueryBuilder('a')
                ->andWhere('a.estado = 1  ');

            },*/
            'query_builder' => function(DiscusionJefaturaRepository $er ){
                return $er->createQueryBuilder('a')
                ->orderBy('a.id', 'DESC')
                ->addOrderBy('a.id', 'DESC')
                ;

            },
            
            'placeholder' => 'Selecione la discusion',
            'attr'=> array('class' => 'myselect'),
        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
