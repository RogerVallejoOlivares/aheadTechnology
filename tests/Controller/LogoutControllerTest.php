<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogoutControllerTest extends WebTestCase
{
    private $client;

    public function setUp() {
        $client = static::createClient();
        $client->followRedirects();

        $this->client = $client;
    }

    public function testLogout() {
        $crawler = $this->client->request('GET', '/logout');

        $this->assertEquals(
            'http://localhost/login',
            $crawler->getUri()
        );
    }
}
