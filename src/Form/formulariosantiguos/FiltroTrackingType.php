<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltroTrackingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $identificador= $options['identificador'];
        //dump($identificador); die;
        $builder
            ->add('vin', TextType::class, array('required' => false ,'data'=>'', 'attr'=>array('class'=>"form-control", 'placeholder'=>"vin", 'pattern' => '^[A-Za-z0-9]{17}')))
            ->add('lote', TextType::class, array('required' => false , 'data'=>$identificador, 'attr'=>array('class'=>"form-control", 'placeholder'=>"lote", 'pattern' => '^[A-Za-z0-9]{8}')))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'identificador'=>'',
        ]);
    }
}
