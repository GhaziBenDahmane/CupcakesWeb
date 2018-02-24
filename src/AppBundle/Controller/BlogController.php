<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function blogListingAction()
    {
        return $this->render('PastryBundle:Blog:blog-listing.html.twig');
    }
    public function blogDetailAction()
    {
        return $this->render('PastryBundle:Blog:blog-detail.html.twig');
    }

}
