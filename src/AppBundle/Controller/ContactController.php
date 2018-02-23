<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function ContactAction()
    {
        return $this->render('AppBundle:Contact:contact.html.html.twig');
    }
}
