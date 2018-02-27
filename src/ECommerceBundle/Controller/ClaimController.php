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
        $em = $this->getDoctrine()->getManager();
        $claims = $em->getRepository('ECommerceBundle:Claim')
            ->findBy(array('client' => $this->getUser()));


        return $this->render('ECommerceBundle:claim:index.html.twig',
            array('claims' => $claims));
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

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
            $em->persist($claim);
            $em->flush($claim);
            $twilio = $this->get('twilio.api');

            $twilio->account->messages->sendMessage(
                '+19283230909 ',
                '+21626879552',
                "New claim From " . $this->getUser()
            );
            $users = $em->getRepository('UserBundle:User')->findAll();
            $manager = $this->get('mgilet.notification');
            $notif = $manager->createNotification('New Claim !');
            $notif->setMessage('By ' . $this->getUser() . '.');
            $notif->setLink('/admin/claim/');
            foreach ($users as $user) {
                if ($user->hasRole('ROLE_ADMIN')) {
                    $manager->addNotification(array($user), $notif, true);
                }
            }
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
