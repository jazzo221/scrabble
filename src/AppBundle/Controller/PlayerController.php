<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PlayerController
 * @package AppBundle\Controller
 *
 * @Route("/player")
 */
class PlayerController extends BaseController
{

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(PlayerType::class);
        $this->addSubmit($form);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->get('doctrine.orm.default_entity_manager');
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success','Player created');
        }

        return [
            'form'=>$form->createView()
        ];
    }
}
