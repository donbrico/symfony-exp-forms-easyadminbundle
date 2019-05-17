<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AdminTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin1@gmail.com',
            'PHP_AUTH_PW'   => 'password',
        ));
        $client->request('GET', '/article');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString("Articles", $client->getResponse()->getContent());
    }
}
