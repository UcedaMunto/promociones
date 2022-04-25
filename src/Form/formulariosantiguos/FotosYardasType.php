<?php

namespace App\Form;
use App\Entity\Envio;
use App\Repository\EnvioRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;

class FotosYardasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $yardaId =$options['yardaId'];
        $envioId =$options['envioId'];

        //dump($envioId); die;

        $builder->add('files',  FileType::class , [
            'label' => 'Seleccione las fotos',
            'multiple' => true,
            'attr'=>array('class'=>'form-control'),
            'mapped' => false,
            'required' => false,
            'data_class'=>null,
            'constraints' => [
                new All([
                    'constraints' => [
                        new File([
                        'maxSize' => '20024k',
                        'mimeTypesMessage' => 'Please upload a valid file',
                            'mimeTypes' => [
                                "image/*",
                            ]
                        ]),
                    ],
                ])
            ],
            
        ])
        ->add('keyEstatus', ChoiceType::class, [
                'choices' => [
                    'Select' => null,
                    'key received' => 1,
                    'without key' => 2,
                    'key pendant' => 3,
                ],
                'required' => true,
                'attr'=>array('class'=>'form-control',),
            ])

            ->add('titleEstatus', ChoiceType::class, [
                'choices' => [
                    'Select' => null,
                    'Title received' => 1,
                    'not title' => 2,
                    'Pending title' => 3,
                ],
                'attr'=>array('class'=>'form-control'),
            ])

            ->add('titleFile',  FileType::class , [
                'label' => 'file pdf or word',
                'required' => false,
                'data_class'=>null,
                'attr'=>array('class'=>'form-control'),
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/msword',
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid file',
                    ])
                ],
            ])
        
        ;
        // Los envios del Choice se cambian dinamicamente en caso de que ya se tenga seleccionado un envio:
        if($envioId==0){
            $builder->add('listaAutos',EntityType::class,  array(
                'class' => Envio::class,
                'query_builder' => function (EnvioRepository $er) use ( $yardaId){
                    return $er->createQueryBuilder('a')
                    ->leftJoin('a.detalleCompra', 'dc')
                    ->leftJoin('a.flete', 'fle')
                    ->leftJoin('a.envioContedor', 'ec')
                    ->leftJoin('fle.yarda', 'ya')
                    ->andWhere('ya.id = :yarda')
                    ->setParameter('yarda', $yardaId)
                    ->orderBy('a.id', 'ASC');
                },
                'placeholder' => 'lote or vin',
                'required' => true,
                'mapped'=>false,
                'multiple'=>false,
                'choice_attr' => function ($val, $key, $index) {
                    return array('data-auto' => $val->getDetalleCompra()->getModelo()->getNombre().'-'.$val->getDetalleCompra()->getModelo()->getMarca(),
                                'data-titulo' => $val->getDetalleCompra()->getTitulo(),
                                'data-key' => $val->getDetalleCompra()->getLlave(),
                    );
                },
                'choice_label'=>'identificador','attr'=> array('class' => 'myselect2',)
                )
            );

        }else{
            $builder->add('listaAutos',EntityType::class,  array(
                'class' => Envio::class,
                'query_builder' => function (EnvioRepository $er) use ( $yardaId, $envioId){
                    return $er->createQueryBuilder('a')
                    ->leftJoin('a.detalleCompra', 'dc')
                    ->leftJoin('a.flete', 'fle')
                    ->leftJoin('a.envioContedor', 'ec')
                    ->leftJoin('fle.yarda', 'ya')
                    ->andWhere('ya.id = :yarda')
                    ->andWhere('a.id = :envio')
                    ->setParameter('yarda', $yardaId)
                    ->setParameter('envio', $envioId)
                    ->orderBy('a.id', 'ASC');
                },
                'required' => true,
                'mapped'=>false,
                'multiple'=>false,
                'choice_attr' => function ($val, $key, $index) {
                    return array('data-auto' => $val->getDetalleCompra()->getModelo()->getNombre().'-'.$val->getDetalleCompra()->getModelo()->getMarca(),
                                'data-titulo' => $val->getDetalleCompra()->getTitulo(),
                                'data-key' => $val->getDetalleCompra()->getLlave(),
                    );
                },
                'choice_label'=>'identificador','attr'=> array('class' => 'myselect2',)
                )
            );
        }

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            'yardaId'=> 0,
            'envioId'=> 0,
        ]);
    }
}
