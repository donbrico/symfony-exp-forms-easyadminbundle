<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for($x=0;$x<10;$x++){
            $user = new User();
            $user->setEmail(sprintf("admin%d@gmail.com", $x));
            $user->setFirstName(sprintf("Admin %d", $x));
            $user->setRoles([
                'ROLE_ADMIN'
            ]);
            $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'password'));

            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);

            $manager->persist($user);
        }

        for($x=0;$x<10;$x++){
            $user = new User();
            $user->setEmail(sprintf("user%d@gmail.com", $x));
            $user->setFirstName(sprintf("User %d", $x));
            $user->setRoles([
                'ROLE_USER'
            ]);
            $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'password'));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
