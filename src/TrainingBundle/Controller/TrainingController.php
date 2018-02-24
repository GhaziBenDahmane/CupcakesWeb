<?php

namespace TrainingBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use TrainingBundle\Entity\Training;

/**
 * Training controller.
 *
 */
class TrainingController extends Controller
{
    /**
     * Lists all Training entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $training = $em->getRepository('TrainingBundle:Training')->findAll();

        return $this->render('TrainingBundle:training:index.html.twig', array(
            'training' => $training,
        ));
    }



    /**
     * Creates a new Training entity.
     *
     */
    public function newAction()
    {
        $training = new Training();
        $form = $this->createCreateForm($training);

        return $this->render('TrainingBundle:training:new.html.twig', array(
            'training' => $training,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Creates a form to create a training entity.
     *
     * @param Training $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Training $entity)
    {
        $form = $this->createForm('TrainingBundle\Form\TrainingType',$entity, array(
            'action' => $this->generateUrl('training_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Create'));

        return $form;
    }
    public function createAction(Request $request)
    {
        $entity = new Training();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('training_index'));
        }

        return $this->render('TrainingBundle:training:new.html.twig', array(
            'training' => $entity,
            'form'   => $form->createView(),
        ));
    }




    /**
     * Finds and displays a Training entity.
     *
     */
    public function showAction(Training $training)
    {
        $deleteForm = $this->createDeleteForm($training);

        return $this->render('TrainingBundle:training:show.html.twig', array(
            'training' => $training,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Training entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TrainingBundle:Training')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find personne entity.');
        }

        $editForm = $this->createEditForm($entity);


        return $this->render('TrainingBundle:training:edit.html.twig', array(
            'training'      => $entity,
            'edit_form'   => $editForm->createView(),

        ));
    }

    /**
     * Creates a form to edit a Training entity.
     *
     * @param Training $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Training $entity)
    {
        $form = $this->createForm('TrainingBundle/Form/TrainingType',$entity, array(
            'action' => $this->generateUrl('training_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Update'));

        return $form;
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TrainingBundle:Training')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Training entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('training_index'));
        }

        return $this->render('TrainingBundle:training:edit.html.twig', array(
            'training'      => $entity,
            'edit_form'   => $editForm->createView(),

        ));
    }
    /**
     * Deletes a Training entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $training = $em->getRepository('TrainingBundle:Training')->find($id);
        $em->remove($training);
        $em->flush();
        return $this->redirectToRoute('training_index');
    }

    /**
     * Creates a form to delete a Training entity.
     *
     * @param Training $training The Training entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Training $training)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('training_delete', array('id' => $training->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
