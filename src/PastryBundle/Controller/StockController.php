<?php

namespace PastryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StockController extends Controller
{
    public function addStockAction()
    {
        return $this->render('PastryBundle:Stock:add_stock.html.twig', array(
            // ...
        ));
    }

    public function showStockAction()
    {
        return $this->render('PastryBundle:Stock:show_stock.html.twig', array(
            // ...
        ));
    }

    public function updateStockAction()
    {
        return $this->render('PastryBundle:Stock:update_stock.html.twig', array(
            // ...
        ));
    }

    public function delStockAction()
    {
        return $this->render('PastryBundle:Stock:del_stock.html.twig', array(
            // ...
        ));
    }

}
