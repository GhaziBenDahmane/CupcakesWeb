<?php

namespace ECommerceBundle\Controller;

use ECommerceBundle\Entity\Claim;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Claim controller.
 *
 */
class ClaimController extends Controller
{
    public function indexAction()
    {

        return $this->render('ECommerceBundle:claim:index.html.twig');
    }

    public function newAction(Request $request)
    {
        $claim = new Claim();
        $form = $this->createForm('ECommerceBundle\Form\ClaimType', $claim);
        $form->handleRequest($request);
        $content = $request->getContent();
        $claim->setClient($this->getUser());
        $data = json_decode($content, true);


        if ($data["ajax"] == "true") {
            $claim->setDescription($data["message"]);
            $claim->setType($data["type"]);
            $claim->setPostedOn(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($claim);
            $em->flush($claim);
            $twilio = $this->get('twilio.api');

            $twilio->account->messages->sendMessage(
                '+19283230909 ', // From a Twilio number in your account
                '+21626879552', // Text any number
                "New claim From " . $this->getUser()
            );


        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($claim);
            $em->flush($claim);

            return $this->redirectToRoute('claim_show', array('id' => $claim->getId()));
        }

        return $this->render('ECommerceBundle:claim:new.html.twig', array(
            'claim' => $claim,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Claim $claim)
    {
        $deleteForm = $this->createDeleteForm($claim);

        return $this->render('ECommerceBundle:claim:show.html.twig', array(
            'claim' => $claim,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Claim $claim)
    {
        $deleteForm = $this->createDeleteForm($claim);
        $editForm = $this->createForm('ECommerceBundle\Form\ClaimType', $claim);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('claim_edit', array('id' => $claim->getId()));
        }

        return $this->render('ECommerceBundle:claim:edit.html.twig', array(
            'claim' => $claim,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function removeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $claim = $em->getRepository(Claim::class)
            ->find($id);
        $em->remove($claim);
        $em->flush($claim);
        return new Response('done');
    }

}
