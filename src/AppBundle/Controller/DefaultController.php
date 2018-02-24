<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $twilio = $this->get('twilio.api');
        $message = $twilio->account->messages->sendMessage(
            '+19283230909 ', // From a Twilio number in your account
            '+21626879552', // Text any number
            "test message!"
        );
        return $this->render('AppBundle::index.html.twig');
    }


}
