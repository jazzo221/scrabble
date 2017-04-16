<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Controller;



use AppBundle\Entity\LetterConfiguration;
use AppBundle\Form\Type\LetterConfigurationType;
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
class LetterController extends BaseController
{

    /**
     * @Route("/")
     * @Template()
     *
     * @return array
     */
    public function indexAction(){
        $repo = $this->getDoctrine()->getRepository('AppBundle:LetterConfiguration');

        return [
            'configurations' => $repo->findAll()
        ];
    }

    /**
     * @Route("/new")
     * @Template("@App/Default/form.html.twig")
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newAction(Request $request)
    {
        $configuration = new LetterConfiguration();
        $form = $this->createForm(LetterConfigurationType::class, $configuration);
        $this->addSubmit($form);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($configuration);
            $manager->flush();

            $this->addFlash('success','Konfiguracia úspešne uložená');
            return $this->redirectToRoute('app_letter_edit',['configuration'=>$configuration->getId()]);
        }

        return [
            'form'=>$form->createView()
        ];

    }

    /**
     * @Route("/{configuration}/edit")
     * @Template("@App/Default/form.html.twig")
     *
     * @return array
     */
    public function editAction(Request $request, LetterConfiguration $configuration)
    {
        $form = $this->createForm(LetterConfigurationType::class, $configuration);
        $this->addSubmit($form);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($configuration);
            $manager->flush();

            $this->addFlash('success','Konfiguracia úspešne uložená');
        }

        return [
            'form'=>$form->createView()
        ];
    }

}