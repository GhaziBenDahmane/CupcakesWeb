<?php

namespace PastryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PastryController extends Controller
{
    public function addPastryAction()
    {
        return $this->render('PastryBundle:Pastry:add_pastry.html.twig', array(
            // ...
        ));
    }

    public function showPastryAction()
    {
        return $this->render('PastryBundle:Pastry:show_pastry.html.twig', array(
            // ...
        ));
    }

    public function updatePastryAction()
    {
        return $this->render('PastryBundle:Pastry:update_pastry.html.twig', array(
            // ...
        ));
    }

    public function delPastryAction()
    {
        return $this->render('PastryBundle:Pastry:del_pastry.html.twig', array(
            // ...
        ));
    }

}
