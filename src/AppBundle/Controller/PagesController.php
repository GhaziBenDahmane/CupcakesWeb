<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function OrderFormAction()
    {
        return $this->render('AppBundle:Pages:order-form.html.twig');
    }



    public function NotFoundAction()
    {
        return $this->render('AppBundle:Pages:404.html.twig');
    }

}
