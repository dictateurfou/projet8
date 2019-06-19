<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DataFixtures\LoadUserData;

class DefaultControllerTest extends WebTestCase
{
	//index without user connected
    public function testIndex()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/');


        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }




}
