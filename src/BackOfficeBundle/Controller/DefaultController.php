<?php

namespace BackOfficeBundle\Controller;

use ECommerceBundle\Entity\Product;
use ECommerceBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackOfficeBundle:admin:indexadmin.html.twig');
    }

}
