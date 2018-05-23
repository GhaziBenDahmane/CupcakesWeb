<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function ContactAction(Request $request)
    {
        $contact = new Contact();
        $content = $request->getContent();
        $data = json_decode($content, true);

        if ($data["ajax"] == "true") {

            $contact->setFirstName($data["firstName"]);
            $contact->setTel($data["tel"]);
            $contact->setEmail($this->getUser()->getEmail());
            $contact->setMessage($data["message"]);
            $contact->setAdress($data["adress"]);
            $em = $this->getDoctrine()->getManager();
            $message = \Swift_Message::newInstance()
                ->setSubject('CupCakes Contact')
                ->setFrom('bakeryvanilla123@gmail.com')
                ->setTo('bakeryvanilla123@gmail.com')
                ->setBody(
                    $this->renderView(
                        'AppBundle:Contact:email.html.twig',

                        array('nom' => $contact->getFirstName())

                    ),
                    'text/html'

                );
            $this->get('mailer')->send($message);
            $em->persist($contact);
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_mail_accuse'));
        }


        return $this->render('AppBundle:Contact:contact.html.html.twig');
    }

    public function successAction()
    {
        return new Response("email sended");
    }

    /**
     * Lists all Contact entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository('AppBundle:Contact')->findBy(array('status' => false));

        return $this->render('AppBundle:Contact:index.html.twig', array(
            'contact' => $contact,
        ));
    }

    public function historyAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository('AppBundle:Contact')->findBy(array('email' => $this->getUser()->getEmail()));

        return $this->render('AppBundle:Contact:contactHistory.html.twig', array(
            'contact' => $contact,
        ));
    }

    public function archiveAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository('AppBundle:Contact')->findBy(array('status' => true));

        return $this->render('AppBundle:Contact:archiveContact.html.twig', array(
            'contact' => $contact,
        ));
    }

    public function newAction(Request $request)
    {
        $product = new Contact();
        $form = $this->createCreateForm($product);
        $form->handleRequest($request);


        if ($form->isValid()) {
            // .. code that saves the user

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
        }


        return $this->render('@App/Contact/new.html.twig', array(
            'contact' => $product,
            'form' => $form->createView(),
        ));
    }


    /**
     * Creates a form to create a personne entity.
     *
     * @param Contact $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contact $entity)
    {
        $form = $this->createForm('AppBundle\Form\addContactType', $entity, array(
            'action' => $this->generateUrl('contact_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Create'));

        return $form;
    }

    public function createAction(Request $request)
    {
        $entity = new Contact();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_index'));
        }

        return $this->render('@App/Contact/new.html.twig', array(
            'product' => $entity,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Contact entity.
     *
     */
    public function showAction(Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('AppBundle:Contact:show.html.twig', array(
            'contact' => $contact,
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

        $contact = $em->getRepository('AppBundle:Contact')->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $editForm = $this->createEditForm($contact);


        return $this->render('AppBundle:Contact:edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Contact $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Contact $contact)
    {
        $form = $this->createForm('AppBundle\Form\ContactType', $contact, array(

            'action' => $this->generateUrl('contact_update', array('id' => $contact->getId())),
            'method' => 'PUT',
        ));
        $form->add('status', ChoiceType::class, array(
            'choices' => array(
                'Not Contacted' => '0',
                'Contacted' => '1'
            )
        ));
        $form->add('submit', SubmitType::class, array('label' => 'Update'));

        return $form;
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository('AppBundle:Contact')->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }


        $editForm = $this->createEditForm($contact);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('You are accepted ')
                ->setFrom('bakeryvanilla123@gmail.com')
                ->setTo($contact->getEmail())
                ->setBody(
                    $this->renderView(
                        'AppBundle:Contact:email.html.twig',

                        array('nom' => $contact->getFirstName())

                    ),
                    'text/html'

                );
            $this->get('mailer')->send($message);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_index'));
        }

        return $this->render('AppBundle:Contact:edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a Contact entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Contact')->find($id);
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('contact_index');
    }

    /**
     * Creates a form to delete a BackProduct entity.
     *
     * @param Contact $contact The BackProduct entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact_delete', array('id' => $contact->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
