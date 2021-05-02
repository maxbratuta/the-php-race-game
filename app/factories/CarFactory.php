<?php

namespace App\Factories;

use App\Vehicle\Car;

/**
 * Class CarFactory
 * @package App\Factories
 */
class CarFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Car ' . (++$this->step)
        ];
    }
}
