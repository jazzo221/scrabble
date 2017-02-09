<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Letter;
use AppBundle\Form\Type\LetterBagType;
use AppBundle\Model\Bag\Bag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class LetterController
 * @package AppBundle\Controller
 *
 * @Route("/letter")
 */
class LetterController extends Controller
{

    /**
     * @Route("/")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request){
        $repo = $this->getDoctrine()->getRepository('AppBundle:Letter');
        $letters = $repo->findAll();

        $bag = new Bag();
        $bag->setLetters($letters);

        $form = $this->createForm(LetterBagType::class,$bag);
        $form->add('submit',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getEntityManager();

            foreach ($bag->getLetters() as $letter){
                $entityManager->persist($letter);
            }
            $entityManager->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

}