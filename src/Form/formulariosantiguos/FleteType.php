<?php

namespace App\Form;
use App\Entity\Flete;
use App\Entity\TipoFlete;
use App\Entity\Yardas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('costo',MoneyType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Costo")))
            ->add('precioVenta',MoneyType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Precio")))
            ->add('tipo', EntityType::class,  array('class' => TipoFlete::class,
            'placeholder' => 'tipo de flete?',
            'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
            ->add('yarda', EntityType::class,  array('class' => Yardas::class,
            'placeholder' => 'yarda?',
            'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flete::class,
        ]);
    }
}
