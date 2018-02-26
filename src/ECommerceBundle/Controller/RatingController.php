<?php
/**
 * Created by IntelliJ IDEA.
 * User: Arshavin
 * Date: 25/02/2018
 * Time: 00:18
 */

namespace ECommerceBundle\Controller;


use ECommerceBundle\Entity\Product;
use ECommerceBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class RatingController extends Controller
{


   public function addRatingAction(Request $request)
   {


               $em = $this->getDoctrine()->getManager();
               $content = $request->getContent();
               $data = json_decode($content, true);
               $vote = $data["vote"];
               $new = new Rating();
               $new->setNbVotes(1);
               $product=$em->getRepository('ECommerceBundle:Product')->find(1);
               $new->setProducts($product);
               $new->setNote(3);
               $em->persist($new);
               $em->flush();

       return new Response('success', 200);

   }

   public function showRatingAction($id=1)
   {
       $em = $this->getDoctrine()->getManager();
       $rating= $em->getRepository('ECommerceBundle:Rating')->find($id);


       return $this->render('ECommerceBundle:Rating:show_rating.html.twig',array('rating'=>$rating) );


   }
}