<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function blogListingAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actualities = $em->getRepository('BackOfficeBundle:Actuality')->findAll();
        foreach ($actualities as $actuality){
            $x = $actuality->getId() % 5 +1;
            $actuality->setPhoto('assets/front/images/blog/img-blog-'.$x.'.jpg');
        }
        return $this->render('PastryBundle:Blog:blog-listing.html.twig',array('actualities' => $actualities));
    }

    public function blogDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $actuality = $em->getRepository('BackOfficeBundle:Actuality')->find($id);
        return $this->render('PastryBundle:Blog:blog-detail.html.twig',
            array('actuality' => $actuality) );
    }

}
