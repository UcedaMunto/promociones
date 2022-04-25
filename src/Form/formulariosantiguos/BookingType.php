<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\ShippingLine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shippingLine', EntityType::class, array(
                'required' => false, 
                'label'=>'Shipping line',
                'class' => ShippingLine::class,
                'attr'=> array('class' => 'myselect'),
            ))
            ->add('numero', TextareaType::class, array(
                'required' => false,
                'label'=>'Booking number',
                'attr'=>array('class'=>"form-control" ,
                    'placeholder'=>"number",
                    'maxlength' => 30)
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
