<?php

namespace PastryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IngredientControllerTest extends WebTestCase
{
    public function testAddingredient()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addIngredient');
    }

    public function testShowingredient()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showIngredient');
    }

    public function testUpdateingredient()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateIngredient');
    }

    public function testDelingredient()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delIngredient');
    }

}
