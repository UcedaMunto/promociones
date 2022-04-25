<?php

namespace App\Form;

use App\Entity\DockReceipt;
use App\Entity\Forwarder;
use App\Entity\Navieras;
use App\Entity\Puertos;
use App\Entity\Pier;
use App\Repository\PuertosRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DockReceiptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $paso = $options['paso'];
        $trackeo = $options['trackeo'];
        if($trackeo == true){
            $builder
            ->add('creacion',  DateType::class,  [
                    'required' => false, 'widget' => 'single_text', 'html5' => false, 
                    'attr' => [ 'class' => 'datepicker form-control','autocomplete' => 'off', 'readOnly'=> true],
                ]
            );
        }else{
            if($paso==0){
                $builder
                ->add('forwarderLicencia', EntityType::class,  array('class' => Forwarder::class,
                    'placeholder' => 'licencia?',
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
                ->add('pier', EntityType::class,  array('class' => Pier::class,
                    'placeholder' => 'Pier?',
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
                ->add('carrier', TextType::class, array('required' => false , 
                    'attr'=>array('class'=>"form-control", 'placeholder'=>"Carrier")))
    
                
                ->add('naviera', EntityType::class,  array('class' => Navieras::class,
                'placeholder' => 'Naviera?',
                'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
                ->add('puertoDescarga', EntityType::class,  array('class' => Puertos::class,
                    'query_builder' => function (PuertosRepository $er){
                            return $er->createQueryBuilder('a')
                            ->andWhere('a.tipoPuerto = 1')
                        // ->setParameter('val', 10)
                            ->orderBy('a.id', 'ASC');
                        },
                    'placeholder' => 'Puerto de destino?',
                    'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
                ->add('bill', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"BILL")))
                ->add('instructions', TextareaType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Descripción")))
                ->add('pesoKg', IntegerType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Pier")))
                ->add('portLoading', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Port Loading")))
                ->add('seal', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Seal")))
                ->add('onward', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Onward")))
                ->add('capacidadKg', IntegerType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"Pier")))
            ;
            }
        }
        if($paso==-1){
            $builder
            ->add('forwarderLicencia', EntityType::class,  array('class' => Forwarder::class,
                'placeholder' => 'licencia?',
                'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
            ->add('naviera', EntityType::class,  array('class' => Navieras::class,
            'placeholder' => 'Naviera?',
            'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect')))
            ->add('puertoDescarga', EntityType::class, 
                array('class' => Puertos::class,
                'query_builder' => function (PuertosRepository $er){
                    return $er->createQueryBuilder('a')
                    ->andWhere('a.tipoPuerto = 1')
                   // ->setParameter('val', 10)
                    ->orderBy('a.id', 'ASC');
                },
                'placeholder' => 'Puerto de destino?',
                'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect'))
                )
            ->add('aes', TextType::class, array('required' => false , 
                'attr'=>array('class'=>"form-control", 'placeholder'=>"AES")))
            ->add('bill', TextType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"BILL")))
            ->add('carrier', TextType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Carrier")))
            ->add('instructions', TextareaType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Descripción")))
            ->add('origen', TextType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Origen")))

            ->add('pesoKg', IntegerType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Pier")))
            ->add('pier', TextType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Pier")))
            ->add('portLoading', TextType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Port Loading")))

            ->add('sear', TextType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Sear")))
            ->add('onward', TextareaType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Onward")))
            ->add('capacidadKg', IntegerType::class, array('required' => false , 
            'attr'=>array('class'=>"form-control", 'placeholder'=>"Pier")))
        ;
           
        }
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DockReceipt::class,
            'paso'=> 0,
            'trackeo' => false,
        ]);
    }
}
