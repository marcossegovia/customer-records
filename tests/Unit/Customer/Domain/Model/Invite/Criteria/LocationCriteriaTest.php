<?php

namespace CustomerRecordsTest\Unit\Customer\Domain\Model\Invite\Criteria;

use CustomerRecords\Customer\Domain\Model\Customer\Customer;
use CustomerRecords\Customer\Domain\Model\Invite\Criteria\LocationCriteria;
use CustomerRecords\Customer\Domain\Model\Location\Location;
use PHPUnit\Framework\TestCase;

class LocationCriteriaTest extends TestCase
{
    /** @test */
    public function shouldExpectToBeatCriteria()
    {
        $reference_location = $this->givenADublinCityLocation();
        $max_distance = $this->givenAMaxDistanceOf(200);
        $customer = $this->givenADublinCustomer();
        $this->assertTrue($this->whenTryingToExecuteTheCriteria($reference_location, $max_distance, $customer));
    }

    /** @test */
    public function shouldExpectToFailCriteria()
    {
        $reference_location = $this->givenASpanishLocation();
        $max_distance = $this->givenAMaxDistanceOf(200);
        $customer = $this->givenADublinCustomer();
        $this->assertFalse($this->whenTryingToExecuteTheCriteria($reference_location, $max_distance, $customer));
    }

    private function givenADublinCityLocation(): Location
    {
        return new Location(53.34536, -6.294);
    }

    private function givenASpanishLocation(): Location
    {
        return new Location(41.4384, 2.1747);
    }

    private function givenADublinCustomer(): Customer
    {
        return Customer::instance(1, 'Ed Sheeran', 53.3506889, -6.2500538);
    }

    private function givenAMaxDistanceOf(float $max_distance): float
    {
        return $max_distance;
    }

    private function whenTryingToExecuteTheCriteria(Location $reference_location, float $max_distance, Customer $customer)
    {
        $location_criteria = new LocationCriteria($reference_location, $max_distance);
        return $location_criteria->isSatisfiedBy($customer);
    }
}
