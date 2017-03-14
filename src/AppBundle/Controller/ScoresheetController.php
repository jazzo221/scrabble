<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Game;
use AppBundle\Entity\Scoresheet;
use AppBundle\Form\Type\ScoresheetType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ScoresheetController
 * @package AppBundle\Controller
 *
 * @Route("/game/{game}/scoresheet")
 */
class ScoresheetController extends BaseController
{

    /**
     * @param Request $request
     *
     * @Route("/")
     * @Template("@App/Scoresheet/form.html.twig")
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newAction(Request $request, Game $game)
    {

        $scoresheet = new Scoresheet();
        $scoresheet->setGame($game);
        $form = $this->createForm(ScoresheetType::class,$scoresheet);
        $this->addSubmit($form);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($scoresheet);
            $manager->flush();

            $this->addFlash('success','Partiár bol úspešne uložený');

            return $this->redirectToRoute('app_scoresheet_edit',[
                'game'=>$game->getId(),
                'scoresheet'=>$scoresheet->getId()
            ]);
        }

        return [
            'form'=>$form->createView()
        ];
    }

    /**
     * @Route("/{scoresheet}/edit")
     * @Template("@App/Scoresheet/form.html.twig")
     */
    public function editAction(Request $request,Scoresheet $scoresheet){

        $form = $this->createForm(ScoresheetType::class,$scoresheet);
        $this->addSubmit($form);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($scoresheet);
            $manager->flush();

            $this->addFlash('success','Partiár bol úspešne uložený');
        }

        return[
            'form'=>$form->createView()
        ];
    }
}