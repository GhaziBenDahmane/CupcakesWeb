<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function ContactAction(Request $request)
    {
        $contact = new Contact();
        $content =$request->getContent();
        $data = json_decode($content, true);

        if($data["ajax"]=="true")
        {

            $contact->setFirstName($data["firstName"]);
            $contact->setTel($data["tel"]);
            $contact->setEmail($data["email"]);
            $contact->setMessage($data["message"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush($contact);
            return new Response("true");
        }


        return $this->render('AppBundle:Contact:contact.html.html.twig');
    }
}
