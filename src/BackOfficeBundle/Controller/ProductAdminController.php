<?php

namespace BackOfficeBundle\Controller;

use ECommerceBundle\Entity\Product;
use ECommerceBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 */
class ProductAdminController extends Controller
{
    /**
     * Lists all BackProduct entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('ECommerceBundle:Product')->findAll();

        return $this->render('ECommerceBundle:Product:index.html.twig', array(
            'products' => $products,
        ));
    }



    /**
     * Creates a new BackProduct entity.
     *
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createCreateForm($product);
        $form->handleRequest($request);




        return $this->render('ECommerceBundle:Product:new.html.twig', array(
            'product' => $product,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Creates a form to create a personne entity.
     *
     * @param Product $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Product $entity)
    {
        $form = $this->createForm('ECommerceBundle\Form\ProductType',$entity, array(
            'action' => $this->generateUrl('product_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Create'));

        return $form;
    }
    public function createAction(Request $request)
    {
        $entity = new Product();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_index'));
        }

        return $this->render('@ECommerce/product/new.html.twig', array(
            'product' => $entity,
            'form'   => $form->createView(),
        ));
    }




    /**
     * Finds and displays a BackProduct entity.
     *
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('ECommerceBundle:product:show_pastry.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BackProduct entity.
     *
     */
    /**
    public function editAction(Request $request, Product $product)
    {
    $deleteForm = $this->createDeleteForm($product);
    $editForm = $this->createForm('ECommerceBundle\Form\ProductType     ', $product);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
    $this->getDoctrine()->getManager()->flush();

    return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
    }

    return $this->render('ECommerceBundle:product:edit.html.twig', array(
    'product' => $product,
    'edit_form' => $editForm->createView(),
    'delete_form' => $deleteForm->createView(),
    ));
    }
     * */
    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECommerceBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find personne entity.');
        }

        $editForm = $this->createEditForm($entity);


        return $this->render('@ECommerce/product/edit.html.twig', array(
            'product'      => $entity,
            'edit_form'   => $editForm->createView(),

        ));
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Product $entity)
    {
        $form = $this->createForm('ECommerceBundle\Form\ProductType',$entity, array(
            'action' => $this->generateUrl('product_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Update'));

        return $form;
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECommerceBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('product_index'));
        }

        return $this->render('ECommerceBundle:product:edit.html.twig', array(
            'product'      => $entity,
            'edit_form'   => $editForm->createView(),

        ));
    }
    /**
     * Deletes a BackProduct entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ECommerceBundle:Product')->find($id);
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a BackProduct entity.
     *
     * @param Product $product The BackProduct entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
