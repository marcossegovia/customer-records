<?php

namespace CustomerRecords\Customer\Application\Service;

final class GetInvitedCustomersWithinLocationRequest
{
    private $max_distance;

    public function __construct(float $a_max_distance)
    {
        $this->max_distance = $a_max_distance;
    }

    public function maxDistance(): float
    {
        return $this->max_distance;
    }
}
