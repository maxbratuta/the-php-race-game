<?php

namespace App\Race;

use App\Track\Track;
use App\Vehicle\Car;
use App\Vehicle\VehicleInterface;

/**
 * Class Race
 * @package App\Race
 */
class Race
{
    /**
     * The current Track instance.
     *
     * @var Track
     */
    private Track $track;

    /**
     * The current RaceResult instance.
     *
     * @var RaceResult
     */
    private RaceResult $raceResult;

    /**
     * The array of the race round results.
     *
     * @var array
     */
    private array $roundResults = [];

    /**
     * The array of the vehicles instances.
     *
     * @var VehicleInterface[]
     */
    private array $vehicles;

    /**
     * The check of race ending.
     *
     * @var bool
     */
    private bool $isRaceEnded;

    /**
     * Race constructor.
     */
    public function __construct()
    {
        $this->track = new Track();
        $this->vehicles = Car::factory(5)->create();
        $this->raceResult = new RaceResult();
    }

    /**
     * I changed the name of this method from 'race' to 'start',
     * because PHP 7.4 thought that race() is the constructor of this class,
     * but this is incorrect because the default return type of this method was RaceResult
     * while the constructor is a void method.
     *
     * Start the race.
     *
     * @return RaceResult
     */
    public function start(): RaceResult
    {
        echo '<p>️🚥 <b>Race</b> has begun.</p>';

        // Set the primary data for the race.
        $round = 0;
        $this->isRaceEnded = false;

        // Array of the current track element for each vehicle.
        $vehicleCurrentElements = [];

        // Array of the maps for each vehicle.
        $vehicleMaps = [];

        // Set the array of the maps and the first track element for each vehicle.
        for ($i = 0; $i < count($this->vehicles); $i++) {
            $vehicleMaps[$i] = $this->track->getMap();
            $vehicleCurrentElements[] = reset($vehicleMaps[$i]);
        }

        do {
            foreach ($this->vehicles as $index => $vehicle) {

                // Move the vehicle relative to the obtained speed based on the current element for this vehicle.
                $vehicle->move($vehicle->getSpeed()[$vehicleCurrentElements[$index]]);

                // Get the max element chunk index for the current element.
                $currentMaxElementChunkIndex = key($vehicleMaps[$index]);

                // Check if the vehicle position index is greater than the current max element chunk index.
                // If TRUE - change element to the new one.
                // If FALSE - continue the race without element changing.
                if ($vehicle->getPosition() >= $currentMaxElementChunkIndex) {

                    // Remove the previous element from the list of map elements for the current vehicle.
                    unset($vehicleMaps[$index][key($vehicleMaps[$index])]);

                    // Check if there are still elements on the track for the current vehicle.
                    if (!empty($vehicleMaps[$index])) {

                        // Set the next element for the vehicle.
                        $nextElement = reset($vehicleMaps[$index]);

                        // Check if the next element is not of the same type as the current one.
                        // If TRUE - set the new element and reset vehicle position.
                        // If FALSE - continue the race without element changing.
                        if ($vehicleCurrentElements[$index] !== $nextElement) {
                            $vehicleCurrentElements[$index] = $nextElement;
                            $vehicle->setPosition(++$currentMaxElementChunkIndex);
                        }
                    } else {
                        $this->checkIfVehicleHasCrossedFinishLine($vehicle);
                    }
                }
            }

            $this->roundResults[] = (new RoundResult(++$round, $this->vehicles[0]->getSortedVehiclesByPosition($this->vehicles)));

        } while (!$this->isRaceEnded);

        return $this->getRaceResults();
    }

    /**
     * Check if the vehicle has crossed the finish line.
     *
     * @param VehicleInterface $vehicle
     */
    private function checkIfVehicleHasCrossedFinishLine(VehicleInterface $vehicle): void
    {
        if ($vehicle->getPosition() > array_key_last($this->track->getMap())) {
            if (!$this->isRaceEnded) {
                $this->isRaceEnded = true;
            }

            $this->raceResult->setWinner($vehicle);
        }
    }

    /**
     * Get the race results.
     *
     * @return \App\Race\RaceResult
     */
    private function getRaceResults(): RaceResult
    {
        echo '<p>🏁 <b>Race</b> has been ended.</p>';

        $this->raceResult->setRoundResults($this->roundResults);

        return $this->raceResult;
    }
}
