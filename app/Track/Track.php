<?php

namespace App\Track;

/**
 * Class Track
 * @package App\Track
 */
class Track
{
    /**
     * Constant of the maximum track elements.
     *
     * @var int
     */
    const MAX_TRACK_ELEMENTS = 2000;

    /**
     * Constant of the minimum length of a series of elements.
     *
     * @var int
     */
    const SERIES_ELEMENTS_MINIMUM_LENGTH = 40;

    /**
     * Constants of track element types.
     *
     * @var string
     */
    const STRAIGHT_ELEMENT_TYPE = 'straight';
    const CURVE_ELEMENT_TYPE = 'curve';


    /** @var array */
    /**
     * The array of the provided track element types.
     *
     * @var string[]
     */
    private static array $elementTypes = [
        self::STRAIGHT_ELEMENT_TYPE,
        self::CURVE_ELEMENT_TYPE
    ];

    /**
     * The array of the map.
     *
     * @var array
     */
    private array $map = [];

    /**
     * Track constructor.
     */
    public function __construct()
    {
        $this->build();
    }

    /**
     * Get the map.
     *
     * @return array
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * Build the track.
     */
    private function build(): void
    {
        $trackSeriesCount = round(self::MAX_TRACK_ELEMENTS / self::SERIES_ELEMENTS_MINIMUM_LENGTH);

        for ($i = 0, $step = 1; $i < $trackSeriesCount; $i++, $step++) {
            $maxElementChunkIndex = $step * self::SERIES_ELEMENTS_MINIMUM_LENGTH;
            $this->map[--$maxElementChunkIndex] = self::$elementTypes[array_rand(self::$elementTypes)];
        }

        echo '<p>🛠 <b>Track</b> has been set.</p>';
    }
}
