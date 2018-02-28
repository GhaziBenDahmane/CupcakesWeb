<?php

namespace ECommerceBundle\Controller;

use ECommerceBundle\Entity\Product;
use ECommerceBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;


/**
 * Product controller.
 *
 */
class ProductController extends Controller
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


        if ($form->isValid()) {
            // .. code that saves the user

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );}



        return $this->render('@ECommerce/Product/new.html.twig', array(
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

        if($request->isXmlHttpRequest())
        {

            $name =$request->request->get('name');
            $type =$request->request->get('type');
            $price =$request->request->get('price');
            $description =$request->request->get('description');


            $entity->setName($name);
            $entity->setType($type);
            $entity->setPrice($price);

            $entity->setDescription($description);



        }
        // $file stores the uploaded PDF file
        /** @var UploadedFile $file */
        $file = $entity->getPhoto();

        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        // moves the file to the directory where brochures are stored
        $file->move(
            $this->getParameter('image_directory'),
            $fileName
        );
        $entity->setPhoto($fileName);
        $file=null;



        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $rating = new Rating();
            $rating->setProducts($entity);
            $rating->setUser(null);
            $rating->setNote(0);
            $em->persist($rating);
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

        return $this->render('ECommerceBundle:product:show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECommerceBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find personne entity.');
        }

        $editForm = $this->createEditForm($entity);


        return $this->render('@ECommerce/Product/edit.html.twig', array(
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

    public function showProductsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('ECommerceBundle:Product')->findProducts();
        $types = $em->getRepository('ECommerceBundle:Product')->findTypes();
        $best =$em->getRepository('ECommerceBundle:Product')->findProductsBestSeller(3);
        $tag=$em->getRepository('ECommerceBundle:Tag')->findTags();



        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('ECommerceBundle:Product:product-listing.html.twig', array('products' => $pagination, 'types' => $types,'bests'=>$best,'tags'=>$tag)
        );

    }

    public function showProductsByPriceAction(Request $request)
    {

        $content = $request->getContent();
        $data = json_decode($content, true);
        $price1 = $data["min"];
        $price2 = $data["max"];
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('ECommerceBundle:Product')->findByPrice($price1, $price2);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9
        /*limit per page*/
        );

        return $this->render('ECommerceBundle:Product:product-grid.html.twig', array('products' => $pagination)
        );


    }

    public function showProductsByCategoryAction(Request $request)
    {

        $content = $request->getContent();
        $data = json_decode($content, true);
        $category = $data["type"];
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('ECommerceBundle:Product')->findByCategory($category);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9
        /*limit per page*/
        );

        return $this->render('ECommerceBundle:Product:product-category.html.twig', array('products' => $pagination)
        );

    }

    public function findProductsAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $content = $request->getContent();
        $data = json_decode($content, true);
        $name = $data["n"];
        $products = $em->getRepository('ECommerceBundle:Product')->findProductsByName($name);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4
        /*limit per page*/
        );


        return $this->render('ECommerceBundle:Product:product-sort.html.twig', array('products' => $pagination)
        );

    }

    public function sortProductsAction(Request $request)
    {
        $products=null;
        $em = $this->getDoctrine()->getManager();
        $content = $request->getContent();
        $data = json_decode($content, true);
        $sort = $data["sort"];
        if($sort=="3")
        {

            $products = $em->getRepository('ECommerceBundle:Product')->SortProductsByType();}
        else if($sort=="2")
        {
            $products = $em->getRepository('ECommerceBundle:Product')->SortProductsByPrice();
        }
        else{            $products = $em->getRepository('ECommerceBundle:Product')->findProducts();
        }
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4
        /*limit per page*/
        );

        return $this->render('ECommerceBundle:Product:product-sort.html.twig', array('products' => $pagination)
        );

    }

    public function showProductDetailsAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('ECommerceBundle:Product')->find($id);
        $products->setNbViewed($products->getNbViewed()+1);
        $em->persist($products);
        $em->flush();
        $best=$em->getRepository('ECommerceBundle:Product')->findProductsBestSeller(4);

        return $this->render('ECommerceBundle:Product:product-detail.html.twig', array('products' => $products,'bests'=>$best));
    }

    public function showMostProductRatedAction(Request $request)
    {
        $products = null;
        $em = $this->getDoctrine()->getManager();
        $content = $request->getContent();
        $data = json_decode($content, true);
        $sort = $data["sort"];
        if ($sort == "1") {
            $products = $em->getRepository('ECommerceBundle:Product')->findProductsMostRated();
        } else {
            $products = $em->getRepository('ECommerceBundle:Product')->findProductsMostViewed();
        }
        return $this->render('ECommerceBundle:Product:product_most_rating.html.twig', array('products' => $products));

    }
    public function showProductsByTagsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $content = $request->getContent();
        $data = json_decode($content, true);
        $name = $data["name"];
        $products = $em->getRepository('ECommerceBundle:Product')->findProductsByTags($name);
        return $this->render('ECommerceBundle:Product:product_most_rating.html.twig', array('products' => $products));
    }


}
