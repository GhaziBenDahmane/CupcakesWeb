<?php

namespace GamingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GamingBundle:Default:index.html.twig');
    }
    public function flappyAction()
    {
        return $this->render('GamingBundle:Default:flappy.html.twig');
    }
}
