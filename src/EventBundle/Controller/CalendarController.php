<?php

namespace EventBundle\Controller;


use EventBundle\Entity\Event;
use EventBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends \fadosProduccions\fullCalendarBundle\Controller\CalendarController
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function loadAction(Request $request) {

        //Get start date
        $createdAt = $request->get('start');
        $endAt = $request->get('end');
        $dataFrom = new \DateTime($createdAt);
        $dataTo = new \DateTime($endAt);

        //Get entityManager
        $manager = $this->get('fados.calendar.service');
        //$events = $manager->getEvents($dataFrom,$dataTo);
        $em = $this->getDoctrine()->getManager();
        if($this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            $events = $em->getRepository(Event::class)->findAll();
        }else{
            $events = $em->getRepository(Event::class)->findAll();

        }
        //$events = $em->getRepository(CompanyEvents::class)->findBy(array('user'=>$this->getUser()));
        $status = empty($events) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        $jsonContent = $manager->serialize($events);


        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        $response->setStatusCode($status);
        return $response;
    }
}
