<?php

namespace ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function ProductListingAction(){
        return $this->render('ECommerceBundle:Product:product-listing.html.twig');
    }
    public function ProductGridAction()
    {
        return $this->render('ECommerceBundle:Product:product-grid.html.twig');
    }
    public function ProductDetailAction()
    {
        return $this->render('ECommerceBundle:Product:product-detail.html.twig');
    }
    public function CartAction()
    {
        return $this->render('ECommerceBundle:Default:cart.html.twig');
    }

    public function CheckoutAction()
    {
        return $this->render('ECommerceBundle:Default:checkout.html.twig', array(
            // ...
        ));
    }


}
