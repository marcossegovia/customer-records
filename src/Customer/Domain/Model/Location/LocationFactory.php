<?php

namespace CustomerRecords\Customer\Domain\Model\Location;

final class LocationFactory
{
    private const IMPORTANT_LOCATIONS = [
        'intercom' => ['latitude' => 53.339428, 'longitude' => -6.257664]
    ];

    public static function intercom(): Location
    {
        return new Location(self::IMPORTANT_LOCATIONS['intercom']['latitude'], self::IMPORTANT_LOCATIONS['intercom']['longitude']);
    }
}
