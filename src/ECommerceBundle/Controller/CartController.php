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
        $product->setNbSeller($product->getNbSeller()+1);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $cart= new Cart();
        $cart->setUser($user);
        $cart->setProduct($product);
        $cart->setQuantite(2);
        $em->persist($cart);
        $em->persist($product);
        $em->flush();

        return new Response("succesful");

    }


    public function showCartAction(Request $request)

    {   $em = $this->getDoctrine()->getManager();


        $price=0;
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id = $user->getId();

        $carts = $em->getRepository('ECommerceBundle:Cart')->findByUser($user_id);
        foreach ($carts as $cart)
        {
            $price=$price+$cart->product->getPrice()*$price;
        }




        return $this->render('ECommerceBundle:Cart:cart.html.twig', array('carts' => $carts,'price'=>$price));

    }

        public function removeFromCartAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository('ECommerceBundle:Cart')->find($id);
            $product1 = $em->getRepository('ECommerceBundle:Product')->find($id);
            if ($product1->getNbSeller() > 0) {

            $product1->setNbSeller($product1->getNbSeller() - 1);
        }
        $em->persist($product1);
        $em->remove($product);

        $em->flush();
        return new Response('success', 200);
    }

    public function verifyCouponAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $content = $request->getContent();
        $data = json_decode($content, true);
        $code = $data["code"];
        $coupon=$em->getRepository('GamingBundle:Coupon')->findOneBy(array('code'=>$code));
         if($coupon == null)
         {
             $test=0;
         }
         else {
             if ($coupon->isUsed()) {
                 $test = 0;
             } else {
                 $test = 1;
                 $coupon->setUsed(true);
                 $em->persist($coupon);
                 $em->flush();
             }
         }


        return $this->render('ECommerceBundle:Cart:Coupon.html.twig', array('promotion'=>$test));


    }






}