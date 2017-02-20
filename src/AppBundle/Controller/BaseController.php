<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;

class BaseController extends Controller
{

    /**
     * @param FormInterface $form
     * @return FormInterface
     */
    protected function addSubmit(FormInterface $form){
        $form->add('submit',SubmitType::class);

        return $form;
    }

}