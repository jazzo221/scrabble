<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\Game;
use AppBundle\Entity\Scoresheet;
use AppBundle\Repository\GameRepository;
use AppBundle\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoresheetType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('player',EntityType::class,[
                'class'=>'AppBundle\Entity\Player',
                'choices'=> $options['players']
            ])
            ->add('points')
            ->add('turn',NumberType::class,[
                'attr'=>[
                    'readonly'=>true,
                    'class'=>'turn'
                ]
            ])
            ->add('word');
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Scoresheet',
            'label'=>false,
            'players'=>[]
        ]);
    }



}