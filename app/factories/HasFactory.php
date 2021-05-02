<?php

namespace App\Factories;

/**
 * Trait HasFactory
 * @package App\Factories
 */
trait HasFactory
{
    /**
     * Get a new factory instance for the model.
     *
     * @param int $instancesCount
     * @return \App\Factories\BaseFactory
     */
    public static function factory(int $instancesCount = 1): BaseFactory
    {
        return (BaseFactory::factoryForModel(get_called_class()))->make($instancesCount);
    }
}
