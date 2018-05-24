<?php

namespace PastryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngredientController extends Controller
{
    public function addIngredientAction()
    {
        return $this->render('PastryBundle:Ingredient:add_ingredient.html.twig', array(
            // ...
        ));
    }

    public function showIngredientAction()
    {
        return $this->render('PastryBundle:Ingredient:show_ingredient.html.twig', array(
            // ...
        ));
    }

    public function updateIngredientAction()
    {
        return $this->render('PastryBundle:Ingredient:update_ingredient.html.twig', array(
            // ...
        ));
    }

    public function delIngredientAction()
    {
        return $this->render('PastryBundle:Ingredient:del_ingredient.html.twig', array(
            // ...
        ));
    }

}
