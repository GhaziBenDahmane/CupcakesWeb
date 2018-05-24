<?php

namespace PastryBundle\Controller;

use PastryBundle\Entity\Pastry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;

class PastryController extends Controller
{
    public function indexPastryAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $pastries = $em->getRepository('PastryBundle:Pastry')->findAll();

        $content =$request->getContent();
        $data = json_decode($content, true);



        if($data["ajax"]=="true")
        {
            $array=array(count($pastries));
            $i=0;
            foreach ($pastries as $item)
            {
                array_push($array,$pastries[$i]->getAddress());
                $i++;

            }

            return new JsonResponse($array);

        }


        return $this->render('PastryBundle:Pastry:index_pastry.html.twig', array(
            'pastries' => $pastries
            ));
    }
    public function listPastryAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $pastries = $em->getRepository('PastryBundle:Pastry')->findAll();

        $content =$request->getContent();
        $data = json_decode($content, true);

            $array=array(count($pastries));
            $i=0;
            foreach ($pastries as $item)
            {
                array_push($array,$pastries[$i]->getAddress());
                $i++;

            }

            return new JsonResponse($array);
    }

    public function addPastryAction(Request $request)
    {

        $pastry= new Pastry();
        $content =$request->getContent();
        $data = json_decode($content, true);
        if($data["ajax"]=="true")
        {
            $pastry->setAddress($data["address"]);
            $pastry->setNbTable($data["nbtable"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pastry);
            $em->flush();

        }
        return $this->redirectToRoute('pastry_homepage');


          }

    public function showPastryAction()
    {
        return $this->render('PastryBundle:Pastry:show_pastry.html.twig', array(
            // ...
        ));
    }

    public function updatePastryAction()
    {
        return $this->render('PastryBundle:Pastry:update_pastry.html.twig', array(
            // ...
        ));
    }

    public function delPastryAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pastry = $em->getRepository('PastryBundle:Pastry')->find($id);
        $em->remove($pastry);
        $em->flush();
        return $this->redirectToRoute('pastry_homepage');
    }

}
