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

    function date_compare($a, $b)
    {
        $t1 = strtotime($a[0]->getDate());
        $t2 = strtotime($b[0]->getDate());
        return $t2 - $t1;
    }

    public function notifAction(Request $request)
    {
        $max_notif_chars = 20;
        $manager = $this->get('mgilet.notification');
        $notifs = $manager->getNotifications($this->getUser());
        $unseen = $manager->getUnseenNotificationCount($this->getUser());
        $htmlclass = $unseen ? "fa fa-bell" : "fa fa-bell-o";
        $humanDate = new HumanDate();
        foreach ($notifs as $key => $value) {
            $notifs[$key][0]->setDate($humanDate->transform($notifs[$key][0]->getDate()));

            if (strlen($notifs[$key][0]->getMessage()) > $max_notif_chars) {
                $notifs[$key][0]->setMessage(substr($notifs[$key][0]->getMessage(), 0, $max_notif_chars) . '..');
            }
        }
        usort($notifs, array($this, 'date_compare'));

        return $this->render('AppBundle::notifs.html.twig', array('notifs' => $notifs, 'class' => $htmlclass));
    }

    public function userNotifsAction(Request $request)
    {
        $max_notif_chars = 20;
        $manager = $this->get('mgilet.notification');
        $notifs = $manager->getNotifications($this->getUser());
        $unseen = $manager->getUnseenNotificationCount($this->getUser());
        $htmlclass = $unseen ? "fa fa-bell" : "fa fa-bell-o";
        $humanDate = new HumanDate();
        foreach ($notifs as $key => $value) {
            $notifs[$key][0]->setDate($humanDate->transform($notifs[$key][0]->getDate()));

            if (strlen($notifs[$key][0]->getMessage()) > $max_notif_chars) {
                $notifs[$key][0]->setMessage(substr($notifs[$key][0]->getMessage(), 0, $max_notif_chars) . '..');
            }
        }
        usort($notifs, array($this, 'date_compare'));

        return $this->render('AppBundle::userNotifs.html.twig', array('notifs' => $notifs, 'class' => $htmlclass));
    }

    public function seenAction(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $manager->markAllAsSeen($this->getUser());
        return new Response('done');
    }

}
