<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PagesControllerTest extends WebTestCase
{
    public function testOrderform()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/OrderForm');
    }

    public function testCheckout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Checkout');
    }

    public function testCart()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Cart');
    }

    public function test404page()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/404Page');
    }

}
