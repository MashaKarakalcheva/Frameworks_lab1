<?php
// tests/Controller/TaskControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testCreate()
    {
        // Create a client to simulate a request
        $client = static::createClient();

        // Send a GET request to the /task/create route
        $client->request('GET', '/task/create');

        // Follow the redirect
        $crawler = $client->followRedirect();

        // Assert that the final response is successful (HTTP status code 200)
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // You can add more assertions here to test the form and submission if needed.
    }

    public function testList()
    {
        // Create a client to simulate a request
        $client = static::createClient();

        // Send a GET request to the /task/list route
        $client->request('GET', '/task/list');

        // Follow the redirect
        $crawler = $client->followRedirect();

        // Assert that the final response is successful (HTTP status code 200)
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // You can add more assertions here to check the content of the list page.
    }

    // Add similar tests for other controller actions (view, delete, update).
}
