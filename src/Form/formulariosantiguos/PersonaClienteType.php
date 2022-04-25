<?php

namespace App\Form;

use App\Entity\DatosPersona;
use App\Entity\EstadoCliente;
use App\Entity\PersonaCliente;
use App\Entity\TipoCliente;
use App\Entity\UsuarioCliente;
use App\Repository\PersonaRepository;
use App\Repository\TipoClienteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PersonaClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $editar = $options['editar'];
        $representante = $options['representante'];
        if($editar==0){
            $builder
            ->add('tipoCliente', EntityType::class,  array('class' => TipoCliente::class,
            
            'query_builder' => function (TipoClienteRepository $er){
                return $er->createQueryBuilder('a')
                ->where('a.id= 3')
                ->orderBy('a.id', 'ASC');
            },
            'required' => true,'choice_label'=>'nombre','attr'=> array(
                'class' => 'form-control', ))
            );
            //$builder->add('usuario',  UsuarioClienteType::class );
            $builder->add('representante', EntityType::class,  array('class' => PersonaCliente::class,
            'placeholder' => 'representante?',
            'required' => false,'choice_label'=>'dataCombobox','attr'=> array('class' => 'myselect'))
            );
            $builder->add('datos',  DatosPersonaType::class, );
            $builder->remove('datos.estado');
        }
        if($editar==1){
            
            $builder->add('datos',  DatosPersonaType::class, array( ) )
            ->add('estado', EntityType::class,  array('class' => EstadoCliente::class,
            'placeholder' => 'estado?',
            'required' => true,'choice_label'=>'nombre','attr'=> array('class' => 'myselect'))
        );
            

           /* $builder->add('datos',  DatosPersonaType::class, array(
                'remove'=> 'giro,nombre,apellido,nit,dui,estado' ) 
            );*/

            $builder->get('datos')->remove('ncr');
            //$builder->get('datos')->remove('nombre');
            //$builder->get('datos')->remove('dui');
            //$builder->get('datos')->remove('nit');
            //$builder->get('datos')->remove('apellido');
            $builder->get('datos')->remove('giro');
        }

        if($editar==3)
        {
            $builder
            ->add('tipoCliente', EntityType::class,  array('class' => TipoCliente::class,
            
            'query_builder' => function (TipoClienteRepository $er){
                return $er->createQueryBuilder('a')
                ->where('a.id= 5')
                ->orderBy('a.id', 'ASC');
            },
            'required' => true,'choice_label'=>'nombre','attr'=> array(
                'class' => 'form-control', ))
            );
            //$builder->add('usuario',  UsuarioClienteType::class );
            $builder->add('representante', EntityType::class,  array('class' => PersonaCliente::class,
            'placeholder' => 'representante?',
            'required' => false,'choice_label'=>'dataCombobox','attr'=> array('class' => 'myselect'))
            );
            $builder->add('datos',  DatosPersonaType::class, );
            $builder->remove('datos.estado');
        } 
        
        if($editar==4)
        {
            $builder
            ->add('tipoCliente', EntityType::class,  array('class' => TipoCliente::class,            
            'query_builder' => function (TipoClienteRepository $er){
                return $er->createQueryBuilder('a')
                ->where('a.id= 6')
                ->orderBy('a.id', 'ASC');
            },
            'required' => true,'choice_label'=>'nombre','attr'=> array(
                'class' => 'form-control', ))
            );
            //$builder->add('usuario',  UsuarioClienteType::class );
            $builder->add('representante', EntityType::class,  array('class' => PersonaCliente::class,
            'placeholder' => 'representante?',
            'required' => false,'choice_label'=>'dataCombobox','attr'=> array('class' => 'myselect'))
            );
            $builder->add('datos',  DatosPersonaType::class, array('Bandera'=>'empresa') );            
           
        }        
    
    if($editar==5)
        {             
            //$builder->add('usuario',  UsuarioClienteType::class );
            $builder->add('representante', EntityType::class,  array('class' => PersonaCliente::class,
            'placeholder' => 'representante?',
            'required' => false,'choice_label'=>'dataCombobox','attr'=> array('class' => 'myselect'))
            );
            $builder->add('datos',  DatosPersonaType::class, );
            
        } 
    
    
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonaCliente::class,
            'editar' => 0,
            'representante' => 0
        ]);
    }
}
