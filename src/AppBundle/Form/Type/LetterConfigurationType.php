<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LetterConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('name')
            ->add('letters',CollectionType::class,[
                'entry_type'=>LetterType::class,
                'allow_add'=>true,
                'allow_delete'=>true,
                'attr'=>[
                    'class'=>'form-inline'
                ],
                'by_reference'=>false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\LetterConfiguration'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_letter_configuration_type';
    }
}
