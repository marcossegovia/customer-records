<?php

namespace CustomerRecords\Customer\Domain\Model\Invite\Criteria;

use CustomerRecords\Customer\Domain\Model\Customer\Customer;
use CustomerRecords\Customer\Domain\Model\Invite\InvitationCriteria;
use CustomerRecords\Customer\Domain\Model\Location\Location;

final class LocationCriteria implements InvitationCriteria
{
    private $from_location;
    private $max_distance;

    public function __construct(Location $a_from_location, float $a_max_distance)
    {
        $this->from_location = $a_from_location;
        $this->max_distance = $a_max_distance;
    }

    public function isSatisfiedBy(Customer $a_customer): bool
    {
        $customer_location = $a_customer->location();
        if ($this->max_distance <= $this->from_location->distanceTo($customer_location)) {
            return false;
        }

        return true;
    }
}
