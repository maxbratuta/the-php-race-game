<?php

namespace App\Race;

use App\Vehicle\VehicleInterface;

/**
 * Class RoundResult
 * @package App\Race
 */
class RoundResult
{
    /**
     * The number of the round.
     *
     * @var int
     */
    private int $round;

    /**
     * The array of the vehicles instances.
     *
     * @var VehicleInterface[]
     */
    private array $vehiclePositions;

    /**
     * RoundResult constructor.
     *
     * @param int $round
     * @param array $vehiclePositions
     */
    public function __construct(int $round, array $vehiclePositions)
    {
        $this->round = $round;
        $this->vehiclePositions = $vehiclePositions;
    }

    /**
     * Get the round.
     *
     * @return int
     */
    public function getRound(): int
    {
        return $this->round;
    }

    /**
     * Get the vehicle positions.
     *
     * @return array
     */
    public function getVehiclePositions(): array
    {
        return $this->vehiclePositions;
    }
}

