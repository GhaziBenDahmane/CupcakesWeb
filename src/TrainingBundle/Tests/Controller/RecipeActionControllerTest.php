<?php

namespace TrainingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecipeActionControllerTest extends WebTestCase
{
    public function testAddrecipe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addRecipe');
    }

    public function testShowrecipe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showRecipe');
    }

    public function testUpdaterecipe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateRecipe');
    }

    public function testDelrecipe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delRecipe');
    }

}
