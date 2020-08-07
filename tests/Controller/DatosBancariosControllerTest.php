<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DatosBancariosControllerTest extends WebTestCase
{
    private $client;

    public function setUp() {
        $client = static::createClient();
        $client->followRedirects();

        $this->client = $client;
    }

    public function testMostrarFormDatos() {
        $this->client->request('GET', '/datos');
        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * No consigo hacer que funcione, me salta: InvalidArgumentException: The current node list is empty.
    */
    public function testFormDatosVacio() {
        $crawler = $this->client->request('GET', '/datos');
        $form = $crawler->selectButton('dato_bancarios[save]')->form();

        $form['datos_bancarios[IBAN]'] = '';
        $form['datos_bancarios[DireccionFacturacion]'] = '';
        $form['datos_bancarios[DNI]'] = '';


        $crawler = $this->client->submit($form);

        $this->assertEquals(
            'http://localhost/datos',
            $crawler->getUri()
        );
    }

    /**
     * No consigo hacer que funcione, me salta: InvalidArgumentException: The current node list is empty.
     */
    public function testFormDatosValido() {
        $crawler = $this->client->request('GET', '/datos');
        $form = $crawler->selectButton('datos_bancarios[save]')->form();

        $form['datos_bancarios[IBAN]'] = '1245123';
        $form['datos_bancarios[DireccionFacturacion]'] = 'Sabadell';
        $form['datos_bancarios[DNI]'] = '47167185R';

        $crawler = $this->client->submit($form);

        $this->assertEquals(
            1,
            $crawler->filter('h1.success')->count()
        );
    }
}
