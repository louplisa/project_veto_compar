<?php

namespace App\Factory;

use App\Entity\User;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<User>
 */
final class UserFactory extends PersistentProxyObjectFactory
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();

        $this->passwordHasher = $passwordHasher;
    }

    public static function class(): string
    {
        return User::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->email,
            'firstname' => self::faker()->firstName,
            'lastname' => self::faker()->lastName,
            'password' => 'password',
            'roles' => [],
        ];
    }

    protected function initialize(): static
    {
        return $this
             ->afterInstantiate(function(User $user): void {
                 $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
             })
        ;
    }
}
