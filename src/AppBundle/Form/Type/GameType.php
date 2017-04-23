<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateTimeType::class,[
                'label'=>'Dátum',
                'data'=>new \DateTime()
            ])
            ->add('players',EntityType::class,[
                'class'=>'AppBundle\Entity\Player',
                'multiple'=>true,
                'choice_label'=>'name',
                'label'=>'Hráči'
            ])
            ->add('letterConfiguration', EntityType::class,[
                'class'=>'AppBundle\Entity\LetterConfiguration',
                'choice_label'=>'name',
                'required'=>true,
                'label'=>'Konfigurácia'
            ])
        ;


    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class'=>'AppBundle\Entity\Game'
        ]);
    }


}