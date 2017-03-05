<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\Scoresheet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoresheetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $data = $builder->getData();
//        var_dump($data);
//        exit;
        $builder
            ->add('totalPoints')
            ->add('turns',CollectionType::class,[
            'allow_add'=>true,
            'allow_delete'=>true,
            'entry_type'=>TurnType::class,
            'entry_options'=>[
                'players'=>  $data instanceof Scoresheet ? $data->getGame()->getPlayers() : []
            ],
            'label'=>false,
            'prototype'=>true,
            'by_reference'=>false,
        ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Scoresheet'
        ]);
    }


}