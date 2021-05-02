<?php

namespace App\Vehicle;

/**
 * Interface VehicleInterface
 * @package App\Vehicle
 */
interface VehicleInterface
{
    /**
     * Get the vehicle type.
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get the vehicle name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the vehicle speed.
     *
     * @return array
     */
    public function getSpeed(): array;

    /**
     * Get the vehicle position.
     *
     * @return int
     */
    public function getPosition(): int;

    /**
     * Move the vehicle.
     *
     * @param int $speed
     */
    public function move(int $speed): void;
}
