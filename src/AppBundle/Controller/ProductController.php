<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends Controller
{
    public function ProductListingAction(){
        return $this->render('AppBundle:Product:product-listing.html.twig');
    }
    public function ProductGridAction()
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Product:product-grid.html.twig');
    }
    public function ProductDetailAction()
    {
        return $this->render('AppBundle:Product:product-detail.html.twig');
    }
}
