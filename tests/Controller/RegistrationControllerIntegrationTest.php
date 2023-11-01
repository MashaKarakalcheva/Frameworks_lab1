<?php
// tests/Controller/RegistrationControllerIntegrationTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RegistrationControllerIntegrationTest extends WebTestCase
{
    public function testRegisterAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        
        $this->assertSelectorExists('form[name="registration_form"]');
        $this->assertSelectorExists('input[name="registration_form[plainPassword]"]'); // Updated selector

        // You can add more assertions to test form rendering and submission, if needed.
    }
}
