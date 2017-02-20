<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoresheetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('player')
            ->add('points')
            ->add('turn',NumberType::class,[
                'attr'=>[
                    'readonly'=>true
                ]
            ])
            ->add('word');
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Scoresheet'
        ]);
    }



}