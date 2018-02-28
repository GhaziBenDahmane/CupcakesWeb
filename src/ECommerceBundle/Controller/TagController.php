<?php
/**
 * Created by IntelliJ IDEA.
 * User: Arshavin
 * Date: 27/02/2018
 * Time: 03:35
 */

namespace ECommerceBundle\Controller;


use ECommerceBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function addTagAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $content = $request->getContent();
        $data = json_decode($content, true);
        $name = $data["name"];
        $id = $data["id"];
        $new = new Tag();
        $product=$em->getRepository('ECommerceBundle:Product')->find($id);
        $new->setProduct($product);
        $new ->setName($name);
        $em->persist($new);
        $em->flush();

        return new Response('success', 200);

    }
}