<?php

namespace App\Form;

use App\Entity\Cheques;
use App\Entity\PreFactGruaUsa;
use App\Entity\Grueros;
use App\Repository\GruerosRepository;
use App\Repository\PreFactGruaUsaRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChequesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('correlativo', TextType::class,  array('required' => true , 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Correlativo")))
            ->add('monto',MoneyType::class,  array('required' => true , 'currency'=>'USD', 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Monto")))
            ->add('saldoFavorGenerado', MoneyType::class,  array('required' => false , 'currency'=>'USD', 'attr'=>array('class'=>"form-control" , 'placeholder'=>"Saldo a favor")))
            
            ->add('descripcionCheque', TextareaType::class,  array('required' => false ,  'attr'=>array('class'=>"form-control" , 'placeholder'=>"Descripción cheque")))

            ->add('preFactGruaUsa', EntityType::class, array('class' => PreFactGruaUsa::class,
                    'placeholder' => 'Reporte', 
                    'required' => true,
                    'query_builder' => function (PreFactGruaUsaRepository $er){
                        return $er->createQueryBuilder('a')
                        ->andWhere('a.creacion > :M48h')
                        ->setParameter('M48h', new \DateTime(date("Y/m/d",strtotime( date("Y/m/d")."- 2 day"))))
                        ->orderBy('a.id', 'DESC');
                    },
                    'choice_label'=>'nombre',
                    'attr'=> array('class' => 'myselect'))
            )
            ->add('gruero', EntityType::class, array('class' => Grueros::class,
                    'placeholder' => 'Seleccione...', 
                    'required' => false,
                    'query_builder' => function (GruerosRepository $er){
                        return $er->gruerosValidos();
                    },
                    'choice_label'=>'nombre',
                    'attr'=> array('class' => 'selectCreateOn'))
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cheques::class,
            'csrf_protection'   => false
        ]);
    }
}
