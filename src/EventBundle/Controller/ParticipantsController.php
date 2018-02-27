<?php

namespace EventBundle\Controller;

use EventBundle\Entity\Participants;
use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
/**
 * Participant controller.
 *
 */
class ParticipantsController extends Controller
{
    /**
     * Lists all participant entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $participants = $em->getRepository('EventBundle:Participants')->findAll();

        return $this->render('participants/index.html.twig', array(
            'participants' => $participants,
        ));
    }

    /**
     * Creates a new participant entity.
     *
     */
    public function newAction(Request $request)
    {
        $participant= new Participants();
        $content =$request->getContent();
        $data = json_decode($content, true);



        if($data["ajax"]=="true")
        {

            $participant->setDate(new \DateTime());
            $participant->setIdEvent($data["id_event"]);
            $participant->setIdParticipant($data["id_user"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();
            return new Response("True");
        }



        return $this->render('participants/new.html.twig', array(
            'participant' => $participant,
        ));
    }
    public function listAllAction(Request $request)
    {
        $participant= new Participants();
        $content =$request->getContent();
        $data = json_decode($content, true);



        if($data["ajax"]=="true")
        {

            $em = $this->getDoctrine()->getManager();
            $user= $em->getRepository('EventBundle:Participants')->findUser($data["key"]);
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $jsonContent = $serializer->serialize($user, 'json');
        }

        return new Response($jsonContent);



    }
    /**
     * Finds and displays a participant entity.
     *
     */
    public function showAction(Participants $participant)
    {
        $deleteForm = $this->createDeleteForm($participant);

        return $this->render('participants/show.html.twig', array(
            'participant' => $participant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing participant entity.
     *
     */
    public function editAction(Request $request, Participants $participant)
    {
        $deleteForm = $this->createDeleteForm($participant);
        $editForm = $this->createForm('EventBundle\Form\ParticipantsType', $participant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participants_edit', array('id' => $participant->getId()));
        }

        return $this->render('participants/edit.html.twig', array(
            'participant' => $participant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a participant entity.
     *
     */
    public function deleteAction(Request $request, Participants $participant)
    {
        $form = $this->createDeleteForm($participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participant);
            $em->flush();
        }

        return $this->redirectToRoute('participants_index');
    }

    /**
     * Creates a form to delete a participant entity.
     *
     * @param Participants $participant The participant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Participants $participant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participants_delete', array('id' => $participant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
