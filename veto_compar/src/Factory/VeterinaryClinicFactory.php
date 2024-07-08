<?php

namespace App\Factory;

use App\Entity\VeterinaryClinic;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<VeterinaryClinic>
 */
final class VeterinaryClinicFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return VeterinaryClinic::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'address' => AddressFactory::new(),
            'name' => 'Clinique vétérinaire ' . self::faker()->company(),
            'email' => self::faker()->email(),
            'owner' => [UserFactory::new()],
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(VeterinaryClinic $veterinaryClinic): void {})
        ;
    }
}
