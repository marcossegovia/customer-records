<?php

namespace CustomerRecords\Customer\Domain\Model\Customer;

use CustomerRecords\Customer\Domain\Model\Invite\InvitationCriteria;
use CustomerRecords\Customer\Domain\Model\Location\Location;

final class Customer
{
    private $customerId;
    private $name;
    private $location;

    private function __construct(CustomerId $a_customer_id, string $a_name, Location $a_location)
    {
        $this->customerId = $a_customer_id;
        $this->name = $a_name;
        $this->location = $a_location;
    }

    public static function instance(int $a_customer_id, string $a_name, float $a_latitude, float $a_longitude): Customer
    {
        return new self(new CustomerId($a_customer_id), $a_name, new Location($a_latitude, $a_longitude));
    }

    public function isInvited(InvitationCriteria $an_invitation_criteria): bool
    {
        return $an_invitation_criteria->isSatisfiedBy($this);
    }

    public function customerId(): CustomerId
    {
        return $this->customerId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function doNothing(): bool
    {
        return true;
    }
}
