<?php

namespace App\Form;

use App\Entity\Archivo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CtlTipoArchivo;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\All;

class ArchivoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            //->add('ruta')
            ->add('rutaTemp',  FileType::class , [
                'label' => $options['titulo'],
                'attr'=>array('class'=>'form-control', 'accept' => '.jpg, .jpeg, .png'),
                'required' => $options['require'] ,
                
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Archivo::class,
            'allow_extra_fields' => true,
            'titulo' => 'imagen',
            'require' => false,
        ]);
    }
}
