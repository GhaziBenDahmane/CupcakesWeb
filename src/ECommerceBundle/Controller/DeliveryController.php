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

            $Delivery->setName($data["Name"]);
            $Delivery->setAdress($data["Adress"]);
            $Delivery->setDateDelivery($data["Ddatedelivery"]);
            $Delivery->setPhone($data["phone"]);
            $Delivery->setEmail($data["email"]);
            $Delivery->setContactTime($data["contactTime"]);
            $Delivery->setNotes($data["notes"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Delivery);
            $em->flush();
            return new Response("true");
        }


        return $this->render('ECommerceBundle:Default:order-form.html.twig');
    }
}
