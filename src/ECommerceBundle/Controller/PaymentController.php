<?php
/**
 * Created by IntelliJ IDEA.
 * User: Arshavin
 * Date: 27/02/2018
 * Time: 21:05
 */

namespace ECommerceBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;

class PaymentController extends Controller
{
    public function paymentAction(Request $request,$price)
    {

        $form = $this->get('form.factory')
            ->createNamedBuilder('payment-form')
            ->add('token', HiddenType::class, [
                'constraints' => [new NotBlank()],
            ])
            ->add('submit', SubmitType::class)
            ->getForm();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('ECommerceBundle:Cart')->deleteAllFromCart($user_id);


        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // TODO: charge the card
                try {
                     $this->get('app.client.stripe')->createPremiumCharge($this->getUser(), $form->get('token')->getData(),$price);
                     $this->get('session')->get('premium_redirect');

                } catch (\Stripe\Error\Base $e) {
                    $this->addFlash('warning', sprintf('Unable to take payment, %s', $e instanceof \Stripe\Error\Card ? lcfirst($e->getMessage()) : 'please try again.'));
                    $this->generateUrl('premium_payment');
                } finally {

                    return $this->render('AppBundle::index.html.twig');


                }
            }
        }

        return $this->render('ECommerceBundle:Payment:payment.html.twig', [
            'form' => $form->createView(),
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
        ]);
    }
}