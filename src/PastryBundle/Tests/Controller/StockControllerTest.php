<?php

namespace PastryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StockControllerTest extends WebTestCase
{
    public function testAddstock()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addStock');
    }

    public function testShowstock()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showStock');
    }

    public function testUpdatestock()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateStock');
    }

    public function testDelstock()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delStock');
    }

}
