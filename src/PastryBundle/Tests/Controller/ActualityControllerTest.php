<?php

namespace PastryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActualityControllerTest extends WebTestCase
{
    public function testAddactuality()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addActuality');
    }

    public function testShowactuality()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showActuality');
    }

    public function testUpdateactuality()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateActuality');
    }

    public function testDelactuality()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delActuality');
    }

}
