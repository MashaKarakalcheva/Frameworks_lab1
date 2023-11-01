<?php
// tests/Controller/SecurityControllerTest.php
namespace App\Tests\Controller;

use App\Controller\SecurityController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityControllerTest extends KernelTestCase
{
    private $securityController;
    private $authenticationUtils;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $container = $kernel->getContainer();

        // Mock the AuthenticationUtils service
        $this->authenticationUtils = $this->createMock(AuthenticationUtils::class);

        // Set up any necessary behavior on the mock, if needed
        // For example, $this->authenticationUtils->method('getLastAuthenticationError')->willReturn(...);

        // Create an instance of SecurityController with the mocked services
        $this->securityController = new SecurityController($this->authenticationUtils);
    }

   

    public function testLogout()
    {
        // Call the logout method
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('This method can be blank - it will be intercepted by the logout key on your firewall.');
        $this->securityController->logout();
    }
}
