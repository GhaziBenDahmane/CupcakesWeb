<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Cocur\HumanDate\HumanDate;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('AppBundle::index.html.twig');
    }

    public function notifAction(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');
        $notif->setLink('http://symfony.com/');

        $manager->addNotification(array($this->getUser()), $notif, true);
        $notifs = $manager->getNotifications($this->getUser());
        $humanDate = new HumanDate();

        return $this->render('AppBundle::notifs.html.twig', array('notifs' => $notifs,
            'date' => $humanDate->transform(new \DateTime('now'))));
    }

}
