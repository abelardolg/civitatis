<?php


namespace App\Tests\CivitatisSoftware\Activity\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShowActivitiesControllerTest extends WebTestCase
{

    public function testShowHome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }


}
