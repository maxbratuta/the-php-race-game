<?php

namespace App\Vehicle;

use App\Track\Track;
use ReflectionClass;

/**
 * Class AbstractVehicle
 * @package App\Vehicle
 */
abstract class AbstractVehicle implements VehicleInterface
{
    /**
     * Constant of the minimum vehicle speed.
     *
     * @var int
     */
    const MIN_VEHICLE_SPEED = 4;

    /**
     * Constant of the maximum vehicle speed.
     *
     * @var int
     */
    const MAX_VEHICLE_SPEED = 22;

    /**
     * The vehicle name.
     *
     * @var string
     */
    protected string $name;

    /**
     * The vehicle speed on the straight element type.
     *
     * @var int
     */
    protected int $straightSpeed;

    /**
     * The vehicle speed on the curve element type.
     *
     * @var int
     */
    protected int $curveSpeed;

    /**
     * The vehicle position on the map.
     *
     * @var int
     */
    protected int $position = 0;

    /**
     * AbstractVehicle constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;

        $this->setSpeed();

        echo '<p>🚙 <b>' . $this->getType() . '</b> was created with name - <b>' . $name . '</b></p>';
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }

    /**
     * {@inheritdoc}
     */
    public function getSpeed(): array
    {
        return [
            Track::STRAIGHT_ELEMENT_TYPE => $this->straightSpeed,
            Track::CURVE_ELEMENT_TYPE => $this->curveSpeed,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function move(int $speed): void
    {
        $this->position += $speed;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Method sets vehicle position on the track.
     *
     * @param int $newPosition
     */
    public function setPosition(int $newPosition): void
    {
        $this->position = $newPosition;
    }

    /**
     * Method gets sorted vehicles by position.
     *
     * @param array $vehicles
     * @return array
     */
    public function getSortedVehiclesByPosition(array $vehicles): array
    {
        usort($vehicles, fn($a, $b) => ($a->position <= $b->position));

        return $vehicles;
    }

    /**
     * Method sets the vehicle speed for types of straight and curved elements.
     */
    private function setSpeed(): void
    {
        $this->straightSpeed = rand(self::MIN_VEHICLE_SPEED, self::MAX_VEHICLE_SPEED - self::MIN_VEHICLE_SPEED);
        $this->curveSpeed = self::MAX_VEHICLE_SPEED - $this->straightSpeed;
    }
}
