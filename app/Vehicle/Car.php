<?php

namespace App\Vehicle;

use App\Factories\HasFactory;

/**
 * Class Car
 * @package App\Vehicle
 */
class Car extends AbstractVehicle
{
    use HasFactory;

    /**
     * Car constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
    }
}
