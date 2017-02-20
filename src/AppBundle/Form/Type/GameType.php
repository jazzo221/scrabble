<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\Player;
use AppBundle\Entity\Scoresheet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('players',EntityType::class,[
                'class'=>'AppBundle\Entity\Player',
                'multiple'=>true,
                'choice_label'=>'name',
            ])
            ->add('scoresheet',CollectionType::class,[
                'allow_add'=>true,
                'allow_delete'=>true,
                'entry_type'=>ScoresheetType::class,
                'empty_data'=>new Scoresheet()
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class'=>'AppBundle\Entity\Game'
        ]);
    }


}