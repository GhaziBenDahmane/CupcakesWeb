<?php

namespace ECommerceBundle\Controller;

use ECommerceBundle\Entity\Delivery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use Test\Fixture\Document\Image;
use Vich\UploaderBundle\Handler\DownloadHandler;

class DeliveryController extends Controller
{
    public function DeliveryAction (Request $request)
    {
        $Delivery = new Delivery();
        $today = getdate();
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('ECommerceBundle:Delivery')->findAll();
        $content = $request->getContent();
        $data = json_decode($content, true);
        if ($data["ajax"] == "true") {
            $dateDelivery = \DateTime::createFromFormat('Y-m-d', $data["datedelivery"]);
            $Delivery->setName($data["name"]);
            $Delivery->setAdress($data["adress"]);
            $Delivery->setServiceType($data["serviceType"]);
            $Delivery->setDateDelivery($dateDelivery);
            $Delivery->setContactTime($dateDelivery);
            $Delivery->setPhone($this->getUser()->getPhone());
            $Delivery->setEmail($this->getUser()->getEmail());
            $Delivery->setNotes($data["notes"]);
            $em = $this->getDoctrine()->getManager();
            if ($Delivery->GetserviceType() == 'Free') {
                $filename = rand();
                $container = $this->get('knp_snappy.pdf');
                $container
                ->generateFromHtml(
                    $this->renderView(
                        'ECommerceBundle:order/deliver:freeDeliver.html.twig',
                        array(
                            'id' =>$Delivery->getId(),
                            'date'=>$today,
                            'name' =>$Delivery->getName(),
                            'adress' =>$Delivery->getAdress(),
                            'Service Type' =>$Delivery->getServiceType(),
                            'Phone' =>$Delivery->getPhone(),
                            'email' =>$Delivery->getEmail(),
                            'some'  => $container
                        )
                    ),
                    'uploads/documents/'.$filename.'.pdf'
                );
                $message = \Swift_Message::newInstance()
                    ->setSubject('Free Delivery')
                    ->setFrom('bakeryvanilla123@gmail.com')
                    ->setTo('bakeryvanilla123@gmail.com')

                    ->setBody(
                        $this->renderView(
                            'ECommerceBundle:order/mail:free.html.twig',

                            array('name' => $Delivery->getName(),
                                'id' => $Delivery->getId())
                        ),
                        'text/html'
                    )
                ->attach(\Swift_Attachment::fromPath('uploads/documents/'.$filename.'.pdf'));
            } else {
                $filename2 = rand();
                $container = $this->get('knp_snappy.pdf');
                $container
                    ->generateFromHtml(
                        $this->renderView(
                            'ECommerceBundle:order/deliver:premiumDeliver.html.twig',
                            array(
                                'id' =>$Delivery->getId(),
                                'date'=>$today,
                                'name' =>$Delivery->getName(),
                                'adress' =>$Delivery->getAdress(),
                                'Service Type' =>$Delivery->getServiceType(),
                                'Phone' =>$Delivery->getPhone(),
                                'email' =>$Delivery->getEmail(),
                                'some'  => $container
                            )
                        ),
                        'uploads/documents/'.$filename2.'.pdf'
                    );
                $message = \Swift_Message::newInstance()
                    ->setSubject('Premium Delivery')
                    ->setFrom('bakeryvanilla123@gmail.com')
                    ->setTo('bakeryvanilla123@gmail.com')

                    ->setBody(
                        $this->renderView(
                            'ECommerceBundle:order/mail:premium.html.twig',

                            array('name' => $Delivery->getName(),
                                'id' => $Delivery->getId())

                        ),
                        'text/html'
                    )
                    ->attach(\Swift_Attachment::fromPath('uploads/documents/'.$filename2.'.pdf'));

            }
            $this->get('mailer')->send($message);
            $em->persist($Delivery);
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_mail_accuse'));
        }
        return $this->render('ECommerceBundle:order:order-form.html.twig', array('order' => $order));

    }


    public function indexAction ()
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em->getRepository('ECommerceBundle:Delivery')->findBy(array('status' => false));

        return $this->render('ECommerceBundle:order:index.html.twig', array(
            'order' => $order,
        ));
    }


    public function histroyAction ()
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('ECommerceBundle:Delivery')->findBy(array('email' => $this->getUser()->getEmail()));
        return $this->render('ECommerceBundle:order:history.html.twig', array(
            'order' => $order,
        ));
    }

    public function archiveAction ()
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository('ECommerceBundle:Delivery')->findBy(array('status' => true));

        return $this->render('ECommerceBundle:order:archiveDelivery.html.twig', array(
            'order' => $contact,
        ));
    }


    /**
     * Finds and displays a Delivery entity.
     *
     */
    public function showAction (Delivery $order)
    {
        $deleteForm = $this->createDeleteForm($order);

        return $this->render('ECommerceBundle:order:show.html.twig', array(
            'order' => $order,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Delivery entity.
     *
     */
    public function editAction ($id)
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em->getRepository('ECommerceBundle:Delivery')->find($id);

        if (!$order) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $editForm = $this->createEditForm($order);


        return $this->render('ECommerceBundle:order:edit.html.twig', array(
            'order' => $order,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Creates a form to edit a Delivery entity.
     *
     * @param Delivery $order The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm (Delivery $delivery)
    {
        $form = $this->createForm('ECommerceBundle\Form\DeliveryType', $delivery, array(
            'action' => $this->generateUrl('order_update', array('id' => $delivery->getId())),
            'method' => 'PUT',
        ));
        $form->add('status',ChoiceType::class , array(
            'choices' =>array(
                'Not Delivered'=>'0',
                'Delivered'=>'1'

            )
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Update'));

        return $form;
    }

    public function updateAction (Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em->getRepository('ECommerceBundle:Delivery')->find($id);

        if (!$order) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }


        $editForm = $this->createEditForm($order);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('order_index'));
        }

        return $this->render('ECommerceBundle:order:edit.html.twig', array(
            'order' => $order,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a Delivery entity.
     *
     */
    public function deleteAction (Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('ECommerceBundle:Delivery')->find($id);
        $em->remove($order);
        $em->flush();
        return $this->redirectToRoute('order_index');
    }

    /**
     * Creates a form to delete a Delivery entity.
     *
     * @param Delivery $order The Delivery entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm (Delivery $order)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('order_delete', array('id' => $order->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
