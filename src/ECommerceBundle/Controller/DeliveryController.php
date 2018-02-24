<?php

namespace ECommerceBundle\Controller;

use ECommerceBundle\Entity\Delivery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryController extends Controller
{
    public function DeliveryAction(Request $request)
    {
        $Delivery = new Delivery();
        $content =$request->getContent();
        $data = json_decode($content, true);

        if($data["ajax"]=="true")
        {

            $Delivery->setFirstName($data["firstName"]);
            $Delivery->setTel($data["tel"]);
            $Delivery->setEmail($data["email"]);
            $Delivery->setMessage($data["message"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Delivery);
            $em->flush();
            return new Response("true");
        }


        return $this->render('AppBundle:Contact:contact.html.html.twig');
    }
}
