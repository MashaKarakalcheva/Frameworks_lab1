<?php

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

        $this->authenticationUtils = $this->createMock(AuthenticationUtils::class);

        $this->securityController = new SecurityController($this->authenticationUtils);
    }

   

    public function testLogout()
    {

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('This method can be blank - it will be intercepted by the logout key on your firewall.');
        $this->securityController->logout();
    }
}
