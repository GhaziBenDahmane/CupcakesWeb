<?php

namespace PastryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PastryBundle:Default:index.html.twig');
    }
}
