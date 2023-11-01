<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testCreate()
    {
       
        $client = static::createClient();

        $client->request('GET', '/task/create');

   
        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testList()
    {
        $client = static::createClient();
        $client->request('GET', '/task/list');
        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());


    }

   
}
