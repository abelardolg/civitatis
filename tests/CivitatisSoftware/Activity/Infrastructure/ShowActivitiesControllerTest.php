<?php


namespace App\Tests\CivitatisSoftware\Activity\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ShowActivitiesControllerTest extends WebTestCase
{

    public function testShowHome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

    }

    public function testPageNotFound()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pageNotFound');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode());

    }

    public function testBadRequest()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $form = $crawler->selectButton('Mostrar resultados')->form();

        $form['date'] = 'dd/02/2021';
        $form['quantity'] = '1';

        $crawler = $client->submit($form);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());

    }

    public function testGoodParameters()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $form = $crawler->selectButton('Mostrar resultados')->form();

        $form['date'] = '02/02/2021';
        $form['quantity'] = '1';

        $crawler = $client->submit($form);

        $this->assertEquals(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode());

    }


}
