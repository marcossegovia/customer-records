<?php

namespace CustomerRecords\Customer\Domain\Model\Location;

final class Location
{
    private $latitude;
    private $longitude;

    public function __construct(float $a_latitude, float $a_longitude)
    {
        $this->latitude = $a_latitude;
        $this->longitude = $a_longitude;
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    public function longitude(): float
    {
        return $this->longitude;
    }

    public function distanceTo(Location $a_to_location): float
    {
        $theta = $this->longitude - $a_to_location->longitude();
        $distance = sin(deg2rad($this->latitude)) * sin(deg2rad($a_to_location->latitude())) + cos(deg2rad($this->latitude)) * cos(deg2rad($a_to_location->latitude())) * cos(deg2rad($theta));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $miles = $distance * 60 * 1.1515;
        $kilometers = round($miles * 1.609344, 2);

        return $kilometers;
    }
}
