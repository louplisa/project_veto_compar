<?php

namespace App\DataFixtures;

use App\Entity\User;
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
        $this->faker = Factory::create('fr_FR');
        for ($i = 0 ; $i < 5; $i++) {
            if ($i === 1) {
                $user = new User();
                $user->setEmail('ferre.aurelie@wanadoo.fr');
                $plaintextPassword = 'password';
                $user->setPassword($this->passwordHasher->hashPassword($user, $plaintextPassword));
                $user->setFirstname('Aurélie');
                $user->setLastname('Ferré');
                $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            } else {
                $user = new User();
                $user->setEmail($this->faker->email);
                $plaintextPassword = 'password';
                $user->setPassword($this->passwordHasher->hashPassword($user, $plaintextPassword));
                $user->setFirstname($this->faker->firstName);
                $user->setLastname($this->faker->lastName);
            }

            $manager->persist($user);
        }

        $manager->flush();
    }
}
