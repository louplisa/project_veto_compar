<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\AddressFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected Generator $faker;

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'ferre.aurelie@wanadoo.fr',
            'firstname' => 'Aurélie',
            'lastname' => 'Ferré',
            'password' => 'password',
            'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
        ]);

        UserFactory::createMany(10);
        AddressFactory::createMany(11, function () {
            return [
                'user' => UserFactory::random()
            ];
        });
    }
}
