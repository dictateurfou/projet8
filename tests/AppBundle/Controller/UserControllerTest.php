<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\DataFixtures\DataFixtureTestCase;
use AppBundle\Entity\User;
use AppBundle\DataFixtures\LoadUserData;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends DataFixtureTestCase
{

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function test_get_two_users()
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $this->assertEquals(2, count($users));
    }

    public function testCreateUser(){
        $client = static::createClient();

        $crawler = $client->request('GET', '/users/create');
        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'test1234';
        $form['user[password][first]'] = 'pass1234';
        $form['user[password][second]'] = 'pass1234';
        $form['user[email]'] = 'email@gmail.com';
        $form['user[roles]'] = 'ROLE_USER';
        $crawler = $client->submit($form);
        
        $this->assertTrue(
            $client->getResponse()->isRedirect('/login')
        );
        $crawler = $client->request('GET','/login');

        $this->assertGreaterThan(
            0,
            $crawler->filter('strong:contains("Superbe !")')->count()
        );
        
    }


    public function testUserConnect(){

        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $form['_username'] = 'user';
        $form['_password'] = 'user';
        $crawler = $client->submit($form);

        $crawler = $client->request('GET','/login');

        $this->assertGreaterThan(
            0,
            $crawler->filter('a:contains("Se déconnecter")')->count()
        );
    }


  
}