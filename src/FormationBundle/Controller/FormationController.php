<?php

namespace FormationBundle\Controller;

use FormationBundle\Entity\Formation;
use FormationBundle\Form\FormationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Formation controller.
 *
 */
class FormationController extends Controller
{
    /**
     * Lists all formation entities.
     *
     */

    public function testAction()
    {

        return new Response("test");
    }


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formations = $em->getRepository('FormationBundle:Formation')->findAll();
        return $this->render('@Formation/formation/index.html.twig', array(
            'formations' => $formations,
        ));
    }

    public function searchAction(Request $request)
    {
        $key = $request->get('key');
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('FormationBundle:Formation')->findBy(array('nom'=>$key));
        $_result = array();
        for($i = 0;$i < sizeof($result);$i++){
            $data = array(
                'id' => $result[$i]->getId(),
                'nom' => $result[$i]->getNom(),
                'video' => $result[$i]->getVideo(),
                'starting_date' => $result[$i]->getStartDateFormation(),
                'ending_date' => $result[$i]->getEndDateFormation(),
                'status' => $result[$i]->getStatus(),
            );
            $_result[$i] = $data;
        }
        return $this->json(array('error'=>false, 'result'=>$_result, 'key'=>$key));
    }

    /**
     * Creates a new formation entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function AjouterFormationAction(Request $request)
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('_AfficherFormation', array('id' => $formation->getId()));
        }

        return $this->render('FormationBundle:formation:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a formation entity.
     *
     */
    public function AfficherFormationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('FormationBundle:Formation')->findAll();
        return $this->render('FormationBundle:Formation:index.html.twig', array('formations' => $formation));

    }

    public function FrontFormationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('FormationBundle:Formation')->findAll();
        return $this->render('FormationBundle:formation:Frontformation.html.twig', array('formations' => $formation));


    }

    /**
     * Displays a form to edit an existing formation entity.
     *
     */
    public function ModifierFormationAction(Request $request, $idFormation)
    {
        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('FormationBundle:Formation')->find($idFormation);
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($formation);
            $em->flush();
            return $this->redirectToRoute('_AfficherFormation');

        }


        return $this->render('FormationBundle:Formation:edit.html.twig', array(
            'form' => $form->createView()
        ));


    }


    Public function SupprimerFormationAction($idFormation)
    {
        echo $idFormation;
        $em = $this->getDoctrine()->getManager();
        $Formation = $em->getRepository("FormationBundle:Formation")->find($idFormation);
        $em->remove($Formation);
        $em->flush();
        return $this->redirectToRoute('formation_index');
    }
}
