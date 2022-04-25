<?php

namespace App\Form;

use App\Entity\Cities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city',TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"ciudad")))
            ->add('state_code', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Opcional")))
            ->add('zip', TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"ZIP")))
            ->add('venta',MoneyType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Precio de venta")))
            ->add('county',TextType::class, array('required' => false , 'attr'=>array('class'=>"form-control", 'placeholder'=>"Opcional")))
            //->add('state')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cities::class,
        ]);
    }
}
