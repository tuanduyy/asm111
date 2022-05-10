<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $admin = new User;
        $admin->setUsername("admin");
        $admin->setPassword($this->hasher->hashPassword($admin, "123456"));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $user = new User;
        $user->setUsername("user");
        $user->setPassword($this->hasher->hashPassword($user, "1234"));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $staff = new User;
        $staff->setUsername("staff");
        $staff->setPassword($this->hasher->hashPassword($staff, "12345"));
        $staff->setRoles(['ROLE_STAFF']);
        $manager->persist($staff);

        $manager->flush();
    }
}
