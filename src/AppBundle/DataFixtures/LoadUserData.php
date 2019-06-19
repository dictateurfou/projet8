<?php

// AppBundle/DataFixtures/LoadUserData.php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;
use AppBundle\Enitity\Task;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $data = [
        [
            'username' => 'user',
            'email' => 'user@slowcode.io',
            'password' => 'user',
            'roles' => ['ROLE_USER']
        ],
        [
            'username' => 'admin',
            'email' => 'admin@slowcode.io',
            'password' => 'admin',
            'roles' => ['ROLE_ADMIN']
        ],
    ];

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $em)
    {
        foreach ($this->data as $key => $value) {
            $user = new User();
            $user->setUsername($value["username"]);
            $password = $this->container->get('security.password_encoder')->encodePassword($user, $value["password"]);
            $user->setEmail($value["email"]);
            $user->setRoles($value["roles"]);
            $user->setPassword($password);
            $em->persist($user);
        }
        $em->flush();

        $this->loadTask($em);
    }

    private function loadTask(ObjectManager $em){
        $i = 0;
        while($i < 20){
            $i++;
        }
    }
}