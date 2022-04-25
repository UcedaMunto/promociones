<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltroFechasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fechaInicial = $options['fechaInicial'];
        $fechaFinal = $options['fechaFinal'];
        $builder
            ->add('fechaInicial',  DateType::class,  [ 
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
                'label_format'=> "Y-m-d",
                'data' => new \DateTime($fechaInicial)
            ])
            ->add('fechaFinal',  DateType::class,  [ 
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker form-control', 'autocomplete' => 'off'],
                'label_format'=> "Y-m-d",
                'data' => new \DateTime($fechaFinal)
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'fechaInicial'=> date("Y/m/d",strtotime( date("Y/m/d")."- 4 month")) ,
            'fechaFinal'=> date("Y/m/d")
        ]);
    }
}
