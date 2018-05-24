<?php

namespace PastryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PastryControllerTest extends WebTestCase
{
    public function testAddpastry()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addPastry');
    }

    public function testShowpastry()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showPastry');
    }

    public function testUpdatepastry()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updatePastry');
    }

    public function testDelpastry()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delPastry');
    }

}
