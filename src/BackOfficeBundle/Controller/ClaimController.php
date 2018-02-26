<?php

namespace BackOfficeBundle\Controller;

use ECommerceBundle\Entity\Claim;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Claim controller.
 *
 */
class ClaimController extends Controller
{
    /**
     * Lists all claim entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $claims = $em->getRepository('ECommerceBundle:Claim')->findAll();

        return $this->render('BackOfficeBundle:Claim:index.html.twig', array(
            'claims' => $claims,
        ));
    }


    public function editAction(Request $request, Claim $claim, $id)
    {
        $editForm = $this->createForm('ECommerceBundle\Form\ClaimType', $claim);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            var_dump($id);
            $claim = $em->getRepository(Claim::class)
                ->find($id);
            $claim->setAnswered(true);
            $claim->setAnswer($request->request->get('answer'));
            var_dump($claim);
            $this->getDoctrine()->getManager()->flush();

            return new Response('true');
        }

        return $this->render('BackOfficeBundle:Claim:edit.html.twig', array(
            'claim' => $claim,
            'edit_form' => $editForm->createView()
        ));
    }

    public function answerAction($id, Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, true);

        $em = $this->getDoctrine()->getManager();
        $claim = $em->getRepository(Claim::class)
            ->find($id);
        $claim->setAnswered(true);
        $claim->setAnswer($data['answer']);
        $claim->setAnsweredBy($this->getUser());
        $em->persist($claim);
        $em->flush();
        $twilio = $this->get('twilio.api');

        $message = $twilio->account->messages->sendMessage(
            '+19283230909 ', // From a Twilio number in your account
            $claim->getClient()->getPhone(), // Text any number
            "Your Claim was answered "
        );
        return new Response($claim->getClient());
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
