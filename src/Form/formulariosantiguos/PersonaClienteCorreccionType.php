<?php

namespace App\Form;

use App\Entity\DatosPersona;
use App\Entity\Importador;
use App\Entity\PersonaCliente;
use App\Entity\TipoCliente;
use App\Entity\UsuarioCliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PersonaClienteCorreccionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cliente = $options['cliente'];
        $builder->add('importador', CollectionType::class, [
            'entry_type' => ImportadorType::class,
            'entry_options' => ['label' => false ,'cliente'=> $cliente  ],
        ]);  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonaCliente::class,
            'cliente' => null,
        ]);
    }
}
