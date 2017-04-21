<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LetterType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('letter',TextType::class,[
            'disabled'=> false,
            'label'=>'Písmeno'
        ])
            ->add('points',NumberType::class,[
                'attr'=>[
                    'min'=>0,
                    'max'=>10
                ],
                'label'=>'Body'
            ])
            ->add('count',NumberType::class,[
                'attr'=>[
                    'min'=>0,
                    'max'=>10
                ],
                'label'=>'Počet'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Letter',
        ]);
    }


}