<?php

namespace App\Form;

use App\Entity\CompaniasGrua;
use App\Repository\CompaniasGruaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListaCompaniasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('companias', EntityType::class,array('class' => CompaniasGrua::class,
            'placeholder' => 'Compañías',
            'query_builder' => function (CompaniasGruaRepository $er){
                return $er->createQueryBuilder('a')
                ->orderBy('a.id', 'DESC');
            },
            'choice_label'=>'nombre',
            'label'=>'Seleccione la compañía para la que ingresará autos',
            'required' => false,
            'attr'=> array('class' => 'myselect2', 'min-width'=>'50px'))
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
