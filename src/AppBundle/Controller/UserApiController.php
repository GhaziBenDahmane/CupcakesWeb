<?php
/**
 * Created by PhpStorm.
 * User: ding
 * Date: 4/29/18
 * Time: 8:29 AM
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\Validator\ConstraintViolationList;


class UserApiController extends FOSRestController
{

    public function getUsersAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $entity = $userManager->findUsers();
        if (!$entity) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = $this->view($entity);
        return $this->handleView($view);
    }


    public function getUserAction($slug)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $entity = $userManager->findUserByUsernameOrEmail($slug);
        if (!$entity) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = $this->view($entity);
        return $this->handleView($view);
    }
    public function getUserClaimsAction($slug)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $entity = $userManager->findUserByUsernameOrEmail($slug);

        $em = $this->getDoctrine()->getManager();
        $claims= $em->getRepository('ECommerceBundle:Claim')->findBy(array("client"=>$entity));
        if (!$claims) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = $this->view($claims);
        return $this->handleView($view);
    }


    public function postUserAction(ParamFetcher $paramFetcher)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername($paramFetcher->get('username'));
        $user->setEmail($paramFetcher->get('email'));
        $user->setPlainPassword($paramFetcher->get('password'));
        $user->setName($paramFetcher->get('name'));
        $user->setLastname($paramFetcher->get('lastname'));
        $user->setProfilePicture($paramFetcher->get('photo'));
        $user->setEnabled(true);
        $user->addRole('ROLE_API');
        $view = View::create();
        $errors = $this->get('validator')->validate($user, array('Registration'));
        if (count($errors) == 0) {
            $userManager->updateUser($user);
            $view->setData($user)->setStatusCode(200);
            return $view;
        } else {
            $view = $this->getErrorsView($errors);
            return $view;
        }
    }


    public function putUserAction(ParamFetcher $paramFetcher)
    {
        $entity = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->findOneBy(
            array('id' => $paramFetcher->get('id'))
        );
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($entity->getUsername());
        if ($paramFetcher->get('username')) {
            $user->setUsername($paramFetcher->get('username'));
        }
        if ($paramFetcher->get('email')) {
            $user->setEmail($paramFetcher->get('email'));
        }
        if ($paramFetcher->get('password')) {
            $user->setPlainPassword($paramFetcher->get('password'));
        }
        if ($paramFetcher->get('photo')) {
            $user->setProfilePicture($paramFetcher->get('photo'));
        }
        if ($paramFetcher->get('phone')) {
            $user->setPhone($paramFetcher->get('photo'));
        }

        $view = View::create();
        $errors = $this->get('validator')->validate($user, array('Update'));
        if (count($errors) == 0) {
            $userManager->updateUser($user);
            $view->setData($user)->setStatusCode(200);
            return $view;
        } else {
            $view = $this->getErrorsView($errors);
            return $view;
        }
    }
    public function getFormationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $claims= $em->getRepository('FormationBundle:Formation')->findAll();
        $view = $this->view($claims);
        return $this->handleView($view);
    }

    public function deleteFormationAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $entity= $em->getRepository('FormationBundle:Formation')->find($slug);
        if (!$entity) {
            throw $this->createNotFoundException('Data not found.');
        }
        $em->remove($entity);
        $em->flush();
        $view = View::create();
        $view->setData("Formation deleted.")->setStatusCode(204);
        return $view;
    }

    public function deleteUserAction($slug)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $entity = $userManager->findUserByUsernameOrEmail($slug);
        if (!$entity) {
            throw $this->createNotFoundException('Data not found.');
        }
        $userManager->deleteUser($entity);
        $view = View::create();
        $view->setData("User deteled.")->setStatusCode(204);
        return $view;
    }


    public function getUserSaltAction($slug)
    {
        $entity = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->findOneBy(
            array('username' => $slug)
        );
        if (!$entity) {
            throw $this->createNotFoundException('Data not found.');
        }
        $salt = $entity->getSalt();
        $view = View::create();
        $view->setData(array('salt' => $salt))->setStatusCode(200);
        return $view;
    }


    protected function getErrorsView(ConstraintViolationList $errors)
    {
        $msgs = array();
        $errorIterator = $errors->getIterator();
        foreach ($errorIterator as $validationError) {
            $msg = $validationError->getMessage();
            $params = $validationError->getMessageParameters();
            $msgs[$validationError->getPropertyPath()][] = $this->get('translator')->trans($msg, $params, 'validators');
        }
        $view = View::create($msgs);
        $view->setStatusCode(400);
        return $view;
    }
}
