<?php

namespace App\DataFixtures;

use App\Entity\HealthCare;
use App\Factory\AddressFactory;
use App\Factory\AnimalFactory;
use App\Factory\HealthCareFactory;
use App\Factory\UserFactory;
use App\Factory\VeterinaryClinicFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
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
        AddressFactory::createMany(21);

        UserFactory::createOne([
            'email' => 'ferre.aurelie@wanadoo.fr',
            'firstname' => 'Aurélie',
            'lastname' => 'Ferré',
            'password' => 'password',
            'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
        ]);

        UserFactory::createMany(10, function () {
            return [
                'address' => AddressFactory::random()
            ];
        });

        VeterinaryClinicFactory::createMany(10, function () {
            return [
                'address' => AddressFactory::createOne(),
                'owner' => [UserFactory::random()],
            ];
        });


        $animalsType = [
            'chien',
            'chat',
            'lapin',
            'hamster',
            'oiseau',
            'nac',
        ];

        foreach ($animalsType as $animalType) {
            AnimalFactory::createOne([
                'type' => $animalType,
            ]);
        }

        $healthActs = [
            [
                'name' => 'stérilisation',
                'gender' => 'mâle'
            ],
            [
                'name' => 'stérilisation',
                'gender' => 'femelle'
            ],
            [
                'name' => 'détartrage',
                'gender' => null
            ],
            [
                'name' => 'consultation',
                'gender' => null
            ],
            [
                'name' => 'vaccination',
                'gender' => null
            ]
        ];

        foreach ($healthActs as $healthAct) {
            HealthCareFactory::createOne([
                'name' => $healthAct['name'],
                'gender' => $healthAct['gender']
            ]);
        }
    }
}
