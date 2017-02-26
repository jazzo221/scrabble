<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\Game;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $data = $builder->getData();

        $builder
            ->add('date')
            ->add('players',EntityType::class,[
                'class'=>'AppBundle\Entity\Player',
                'multiple'=>true,
                'choice_label'=>'name',
            ]);

        if(!empty($data)){
            $builder->add('scoresheets',CollectionType::class,[
                'allow_add'=>true,
                'allow_delete'=>true,
                'entry_type'=>ScoresheetType::class,
                'entry_options'=>[
                    'players'=>  $data instanceof Game ? $data->getPlayers() : []
                ],
                'label'=>false,
                'prototype'=>true,
                'by_reference'=>false,
            ]);
        }

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class'=>'AppBundle\Entity\Game'
        ]);
    }


}