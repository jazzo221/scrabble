<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TurnType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number',NumberType::class,[
                'attr'=>[
                    'readonly'=>true,
                    'class'=>'turn'
                ],
                'label'=>'Ťah'
            ])
            ->add('player',EntityType::class,[
                'class'=>'AppBundle\Entity\Player',
                'choices'=> $options['players'],
                'label'=>'Hráč'
            ])
            ->add('word',TextType::class,[
                'label'=>'Hlavné slovo'
            ])
            ->add('points',NumberType::class,[
                'label'=>'Počet bodov'
            ])
            ->add('blankChar',TextType::class,[
                'attr'=>[
                    'help_text'=>'Ak sa nachadza viacero žolíkov, písmena oddeľte čiarkov'
                ],
                'label'=>'Žolík',
                'required'=>false
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Turn',
            'label'=>false,
            'players'=>[]
        ]);
    }



}