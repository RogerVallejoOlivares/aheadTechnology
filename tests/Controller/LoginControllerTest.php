<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{

    private $client;

    public function setUp() {
        $client = static::createClient();
        $client->followRedirects();

        $this->client = $client;
    }

    public function testMostrarLogin() {
        $this->client->request('GET', '/login');
        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testLoginVacio() {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('login[save]')->form();

        $form['login[Nombre]'] = '';
        $form['login[Email]'] = '';

        $crawler = $this->client->submit($form);

        $this->assertEquals(
            'http://localhost/login',
            $crawler->getUri()
        );
    }

    public function testLoginInvalido() {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('login[save]')->form();

        $form['login[Nombre]'] = 'test';
        $form['login[Email]'] = 'test@mail.com';

        $crawler = $this->client->submit($form);

        $this->assertEquals(
            1,
            $crawler->filter('h1.error')->count()
        );
    }

    public function testLoginValido() {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('login[save]')->form();

        $form['login[Nombre]'] = 'roger';
        $form['login[Email]'] = 'roger@mail.com';

        $crawler = $this->client->submit($form);

        $this->assertEquals(
            'http://localhost/datos',
            $crawler->getUri()
        );
    }


}
