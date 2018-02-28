<?php

namespace BackOfficeBundle\Controller;


use EventBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends \fadosProduccions\fullCalendarBundle\Controller\CalendarController
{
    function loadAction(Request $request) {

        //Get start date
        $createdAt = $request->get('start');
        $endAt = $request->get('end');
        $dataFrom = new \DateTime($createdAt);
        $dataTo = new \DateTime($endAt);
        var_dump($createdAt);
        //Get entityManager
        $manager = $this->get('fados.calendar.service');
      //  $events = $manager->getEvents($dataFrom,$dataTo);
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository(Event::class)->findAll();

        $status = empty($events) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        $jsonContent = $manager->serialize($events);
        var_dump($events);
        return new Response("Mohamed haffez");
        /**$response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        $response->setStatusCode($status);*/
    }
}
