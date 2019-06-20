<?php
// tests/AppBundle/Controller/DefaultControllerTest.php
namespace Tests\AppBundle\Controller;

use Tests\AppBundle\DataFixtures\DataFixtureTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class TaskControllerTest extends DataFixtureTestCase
{

    public function setUp()
    {
    	parent::setUp();
    }



    
    public function testGetAllTask(){
    	$client = $this->logUser();

    	$crawler = $client->request('GET', '/tasks');
    	$this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testCreateTask(){
    	$client = $this->logUser();
    	$crawler = $client->Request('GET','/tasks/create');

    	$form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'title its ok';
        $form['task[content]'] = 'content its ok';
        $crawler = $client->submit($form);
        $this->assertTrue(
            $client->getResponse()->isRedirect('/tasks')
        );

        $crawler = $client->request('GET','/tasks');
        $this->assertGreaterThan(
            0,
            $crawler->filter('a:contains("title its ok")')->count()
        );
    }

    public function testDeleteTaks(){
    	$client = $this->logAdmin();
    	$crawler = $client->request('GET', '/tasks');
    	$form = $crawler->selectButton('Supprimer')->form();
    	$crawler = $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirect('/tasks')
        );
        $crawler = $client->request('GET','/tasks');
    	
        $this->assertGreaterThan(
            0,
            $crawler->filter('strong:contains("Superbe !")')->count()
        );
    }

    public function testEditTask(){
    	$client = $this->logUser();
    	$crawler = $client->request('GET', '/tasks/2/edit');
    	$form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'edit title its ok';
        $form['task[content]'] = 'edit content its ok';
        $crawler = $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirect('/tasks')
        );
        $crawler = $client->request('GET','/tasks');
        $this->assertGreaterThan(
            0,
            $crawler->filter('a:contains("edit title its ok")')->count()
        );
    }

    public function testChangeStateTask(){
    	
    }

    
}