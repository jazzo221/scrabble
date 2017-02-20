<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\GameType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameController
 * @package AppBundle\Controller
 *
 * @Route("/game")
 */
class GameController extends Controller
{
    /**
     * @return array
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $form = $this->createForm(GameType::class);

        return [
            'form'=>$form->createView()
        ];
    }
}
