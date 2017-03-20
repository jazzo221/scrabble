<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Form\Type\GameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameController
 * @package AppBundle\Controller
 *
 * @Route("/game")
 */
class GameController extends BaseController
{
    /**
     * @return array
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $games = $this->getDoctrine()->getRepository('AppBundle:Game')->findAll();

        return [
            'games'=>$games
        ];
    }

    /**
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/new")
     * @Template("@App/Game/form.html.twig")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(GameType::class);

        $this->addSubmit($form);
        $form->handleRequest($request);

        if($form->isValid()){
            $data = $form->getData();
            $objectManager = $this->getDoctrine()->getManager();

            $objectManager->persist($form->getData());
            $objectManager->flush();

            return $this->redirectToRoute('app_game_edit',['game'=>$data->getId()]);
        }

        return [
            'form'=>$form->createView()
        ];
    }

    /**
     * @param Request $request
     * @param Game $game
     * @return array
     *
     * @Route("/{game}/edit")
     * @Template("@App/Game/form.html.twig")
     */
    public function editAction(Request $request, Game $game)
    {
        $form = $this->createForm(GameType::class,$game);
        $this->addSubmit($form);
        $form->handleRequest($request);

        if($form->isValid()){
            $objectManager = $this->getDoctrine()->getManager();

            $objectManager->persist($form->getData());
            $objectManager->flush();
        }

        return [
            'form'=>$form->createView()
        ];
    }

    /**
     * @Route("/{game}/Reconstruction")
     * @Template()
     */
    public function reconstructionAction(Game $game){

    }
}
