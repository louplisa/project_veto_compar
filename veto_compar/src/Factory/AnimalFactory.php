<?php

namespace App\Factory;

use App\Entity\Animal;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Animal>
 */
final class AnimalFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return Animal::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'type' => self::faker()->text(255),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Animal $animal): void {})
        ;
    }
}
