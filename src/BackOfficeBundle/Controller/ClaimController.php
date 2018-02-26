<?php

namespace BackOfficeBundle\Controller;

use ECommerceBundle\Entity\Claim;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    
    public function editAction(Request $request, Claim $claim)
    {
        $deleteForm = $this->createDeleteForm($claim);
        $editForm = $this->createForm('ECommerceBundle\Form\ClaimType', $claim);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('claim_edit', array('id' => $claim->getId()));
        }

        return $this->render('BackOfficeBundle:Claim:edit.html.twig', array(
            'claim' => $claim,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a claim entity.
     *
     */
    public function deleteAction(Request $request, Claim $claim)
    {
        $form = $this->createDeleteForm($claim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($claim);
            $em->flush($claim);
        }

        return $this->redirectToRoute('claim_index');
    }

    /**
     * Creates a form to delete a claim entity.
     *
     * @param Claim $claim The claim entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Claim $claim)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('claim_delete', array('id' => $claim->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}