<?php

namespace App\Factory;

use App\Entity\Address;
use Faker\Factory;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Address>
 */
final class AddressFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return Address::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'city' => self::faker()->city(),
            'street' => self::faker()->streetAddress(),
            'complement' => self::faker()->sentence(3),
            'zipCode' => (int) self::faker()->postcode(),
            'user' => UserFactory::new(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Address $address): void {})
        ;
    }
}
