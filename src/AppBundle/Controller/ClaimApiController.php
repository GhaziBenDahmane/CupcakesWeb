<?php
/**
 * Created by PhpStorm.
 * User: ding
 * Date: 4/29/18
 * Time: 5:05 AM
 */

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ECommerceBundle\Entity\Claim;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;

class ClaimApiController extends FOSRestController
{
    public function getDemosAction()
    {
        $token = $this->container->get('security.context')->getToken()->getToken();

        $accessToken = $this->container->get('fos_oauth_server.access_token_manager.default')->findTokenBy(array('token' => $token));
        $client = $accessToken->getClient();
        $em = $this->getDoctrine()->getManager();
        $claims= $em->getRepository('ECommerceBundle:Claim')->findAll();
        $view = $this->view($client);
        return $this->handleView($view);
    }


    public function getClaimsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $claims= $em->getRepository('ECommerceBundle:Claim')->findAll();
        $view = $this->view($claims);
        return $this->handleView($view);
    }
    public function getClaimAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $claims= $em->getRepository('ECommerceBundle:Claim')->find($slug);
        $view = $this->view($claims);
        return $this->handleView($view);
    }
    public function editClaimAction($slug,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $claims= $em->getRepository('ECommerceBundle:Claim')->find($slug);
        $view = $this->view($claims);
        return $this->handleView($view);
    }
    public function newClaimsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $claims= $em->getRepository('ECommerceBundle:Claim')->findAll();
        $view = $this->view($claims);
        return $this->handleView($view);
    }
    public function deleteClaimAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $claims= $em->getRepository('ECommerceBundle:Claim')->find();
        $view = $this->view($claims);
        return $this->handleView($view);
    }

    /**
     * Create a User from the submitted data.<br/>
     *
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="description", nullable=false, strict=true, description="description.")
     * @RequestParam(name="type", nullable=false, strict=true, description="type.")
     * @RequestParam(name="user", nullable=false, strict=true, description="user.")
     *
     * @return View
     */
    public function postClaimAction(ParamFetcher $paramFetcher)
    {
        $em = $this->getDoctrine()->getManager();

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsernameOrEmail($paramFetcher->get("user"));

        $claim=new Claim();
        $claim->setClient($user);
        $claim->setDescription($paramFetcher->get('description'));
        $claim->setType($paramFetcher->get('type'));
        $claim->setPostedOn(new \DateTime('now'));
        $em->persist($claim);
        $em->flush($claim);
        $view = $this->view($claim);
        return $this->handleView($view);
    }


    public function putClaimAction(ParamFetcher $paramFetcher)
    {
        $em = $this->getDoctrine()->getManager();
        $claim =$em->getRepository("ECommerceBundle:Claim")->find($paramFetcher->get("id"));

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsernameOrEmail($paramFetcher->get("user"));

        $claim=new Claim();
        $claim->setClient($user);
        $claim->setDescription($paramFetcher->get('description'));
        $claim->setType($paramFetcher->get('type'));
        $claim->setPostedOn(new \DateTime('now'));
        $em->persist($claim);
        $em->flush($claim);
        $view = $this->view($claim);
        return $this->handleView($view);
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