<?php
/**
 * Created by IntelliJ IDEA.
 * User: Arshavin
 * Date: 25/02/2018
 * Time: 15:18
 */

namespace ECommerceBundle\Controller;


use ECommerceBundle\Entity\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function addToCartAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $product = $em->getRepository('ECommerceBundle:Product')->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $cart= new Cart();
        $cart->setUser($user);
        $cart->setProduct($product);
        $cart->setQuantite(2);
        $em->persist($cart);
        $em->flush();

        return new Response("succesful");

    }


    public function showCartAction()
    {   $price=0;
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id = $user->getId();

        $carts = $em->getRepository('ECommerceBundle:Cart')->findByUser($user_id);
        foreach ($carts as $cart)
        {
            $price=$price+$cart->product->getPrice();
        }

        return $this->render('ECommerceBundle:Cart:cart.html.twig', array('carts' => $carts,'price'=>$price));

    }

        public function removeFromCartAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ECommerceBundle:Cart')->find($id);
        $em->remove($product);
        $em->flush();
        return new Response('success', 200);
    }




}