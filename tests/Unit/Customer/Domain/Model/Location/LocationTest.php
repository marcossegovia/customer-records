<?php

namespace CustomerRecordsTest\Unit\Customer\Domain\Model\Location;

use CustomerRecords\Customer\Domain\Model\Location\Location;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    /**
     * @test
     * @dataProvider coordinatesProvider
     */
    public function shouldReturnACorrectDistanceBetweenTwoLocations($from_latitude, $from_longitude, $to_latitude, $to_longitude, $expected_distance)
    {
        $from_location = $this->givenALocation($from_latitude, $from_longitude);
        $to_location = $this->givenALocation($to_latitude, $to_longitude);
        $this->assertEquals($expected_distance, $from_location->distanceTo($to_location));
    }


    public function coordinatesProvider(): array
    {
        return [
            [32.9697, -96.80322, 29.46786, -98.53506, 422.74],
            [20, 30, 20, 30, 0],
            [20, -30, -20, 30, 7901.43],
            [68, -2, 41, 52, 4363.46],
            [-2, -55, -12, -10, 5080.7],
        ];
    }

    private function givenALocation(float $a_latitude, float $a_longitude): Location
    {
        return new Location($a_latitude, $a_longitude);
    }
}
