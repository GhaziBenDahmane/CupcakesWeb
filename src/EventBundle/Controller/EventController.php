<?php

namespace EventBundle\Controller;

use Doctrine\DBAL\Types\DateType;
use EventBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EventBundle:Event')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $events, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('EventBundle:event:index.html.twig', array(
            'events' => $pagination,
        ));
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm('EventBundle\Form\EventType', $event);
        $form->handleRequest($request);
        $content =$request->getContent();
        $data = json_decode($content, true);



        if($data["ajax"]=="true")
        {
            $startingDate = \DateTime::createFromFormat('Y-m-d', $data["startingDate"]);
            $endingDate = \DateTime::createFromFormat('Y-m-d', $data["endingDate"]);
            $nbPerson =$data["nbPerson"];
            $nbTable =$data["nbTable"];
            $band =$data["band"];
            $cost =$data["cost"];
            $event->setStartingDate($startingDate);
            $event->setEndingDate($endingDate);
            $event->setNbPerson($nbPerson);
            $event->setNbTable($nbTable);
            $event->setBand($band);
            $event->setCost($cost);
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush($event);

        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush($event);

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }

        return $this->render('EventBundle:event:new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('EventBundle:event:show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('EventBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
        }

        return $this->render('EventBundle:event:edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Event $event)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush($event);

        return $this->redirectToRoute('event_index');
    }



}
