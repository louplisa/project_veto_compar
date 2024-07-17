<?php

namespace App\Factory;

use App\Entity\HealthCare;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<HealthCare>
 */
final class HealthCareFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return HealthCare::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->text(255),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(HealthCare $healthCare): void {})
        ;
    }
}
