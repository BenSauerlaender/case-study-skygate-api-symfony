<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist(Role::create('user', 'getAllUsers changeOwnContactData deleteSelf changeOwnPassword changeOwnEmail logoutSelf'));
        $manager->persist(Role::create('admin', 'getAllUsers changeAllUsersContactData deleteAllUsers changeOwnPassword changeAllUsersPasswordsPrivileged changeOwnEmail changeAllUsersEmailPrivileged changeAllUsersRoles logoutSelf'));
        $manager->persist(Role::create('guest', 'getSelf changeOwnContactData deleteSelf changeOwnPassword changeOwnEmail logoutSelf'));

        $manager->flush();
    }
}
