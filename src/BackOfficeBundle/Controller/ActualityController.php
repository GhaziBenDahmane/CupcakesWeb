<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Actuality;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ActualityController extends Controller

{
    /**
     * Lists all Actuality entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actuality = $em->getRepository('BackOfficeBundle:Actuality')->findAll();

        return $this->render('BackOfficeBundle:Actuality:index.html.twig', array(
            'actualities' => $actuality,
        ));
    }



    /**
     * Creates a new Actuality entity.
     *
     */
    public function newAction(Request $request)
    {
        $actuality = new Actuality();
        $form = $this->createCreateForm($actuality);
        $form->handleRequest($request);

        return $this->render('BackOfficeBundle:Actuality:new.html.twig', array(
            'actualities' => $actuality,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Creates a form to create a Actuality entity.
     *
     * @param Actuality $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Actuality $actuality)
    {
        $form = $this->createForm('BackOfficeBundle\Form\ActualityType',$actuality, array(
            'action' => $this->generateUrl('actuality_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Create'));

        return $form;
    }
    public function createAction(Request $request)
    {
        $actuality = new Actuality();
        $form = $this->createCreateForm($actuality);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actuality);
            $em->flush();

            return $this->redirect($this->generateUrl('actuality_index'));
        }

        return $this->render('BackOfficeBundle:Actuality:new.html.twig', array(
            'actualities' => $actuality,
            'form'   => $form->createView(),
        ));
    }




    /**
     * Finds and displays a Actuality entity.
     *
     */
    public function showAction(Actuality $actuality)
    {
        $deleteForm = $this->createDeleteForm($actuality);

        return $this->render('BackOfficeBundle:Actuality:show.html.twig', array(
            'actualities' => $actuality,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $actuality = $em->getRepository('BackOfficeBundle:Actuality')->find($id);

        if (!$actuality) {
            throw $this->createNotFoundException('Unable to find Actuality entity.');
        }

        $editForm = $this->createEditForm($actuality);


        return $this->render('BackOfficeBundle:Actuality:edit.html.twig', array(
            'actualities'      => $actuality,
            'edit_form'   => $editForm->createView(),

        ));
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Actuality $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Actuality $actuality)
    {
        $form = $this->createForm('BackOfficeBundle\Form\ActualityType',$actuality, array(
            'action' => $this->generateUrl('actuality_update', array('id' => $actuality->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Update'));

        return $form;
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $actuality = $em->getRepository('BackOfficeBundle:Actuality')->find($id);

        if (!$actuality) {
            throw $this->createNotFoundException('Unable to find Actuality entity.');
        }


        $editForm = $this->createEditForm($actuality);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('actuality_index'));
        }

        return $this->render('BackOfficeBundle:Actuality:edit.html.twig', array(
            'actualities'      => $actuality,
            'edit_form'   => $editForm->createView(),

        ));
    }
    /**
     * Deletes a BackActuality entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('BackOfficeBundle:Actuality')->find($id);
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('actuality_index');
    }

    /**
     * Creates a form to delete a BackProduct entity.
     *
     * @param Actuality $product The BackProduct entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Actuality $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actuality_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
