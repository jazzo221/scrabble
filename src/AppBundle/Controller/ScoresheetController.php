<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Controller;


use AppBundle\Form\Type\TurnType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ScoresheetController
 * @package AppBundle\Controller
 *
 * @Route("/scoresheet")
 */
class ScoresheetController extends Controller
{

    /**
     * @param Request $request
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $form = $this->createForm(TurnType::class);

        return [
            'form'=>$form->createView()
        ];
    }
}