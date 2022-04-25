<?php

namespace App\Form;

use App\Entity\EstadoImportador;
use App\Entity\Importador;
use App\Entity\PersonaCliente;
use App\Entity\Subasta;
use App\Repository\PersonaClienteRepository;
use App\Repository\PersonaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImportadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cliente = $options['cliente'];
        $builder
            ->add('buyer', TextType::class,  array('required' => false , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"buyer?" )))
            ->add('nombreFactura', TextType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"nombre en la factura?" )))
            ->add('subasta', EntityType::class,  array('class' => Subasta::class,
            'required' => false,'choice_label'=>'nombre','attr'=> array('class' => 'form-control'))
            );
        $builder->add('personaCliente', EntityType::class,  array(
                'class' => PersonaCliente::class,
                'query_builder' => function (PersonaClienteRepository $er) use( $cliente){
                    return $er->createQueryBuilder('a')
                   ->andWhere('a.id =:cliente')
                   ->setParameter('cliente', $cliente);
                },
                'placeholder' => 'de quien es la cuenta', 
                'required' => false,'attr'=> array('class' => 'myselect'),
                ))
                ->add('estado', EntityType::class,  array('class' => EstadoImportador::class,
                'required' => false,'choice_label'=>'nombre','attr'=> array('class' => 'form-control'))
                );
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'cliente'=> 0,
            'data_class'=> Importador::class,
        ]);
    }
}
