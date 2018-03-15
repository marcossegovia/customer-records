<?php

namespace CustomerRecordsTest\Unit\Customer\Domain\Model\Customer;

use CustomerRecords\Customer\Domain\Model\Customer\Customer;
use CustomerRecords\Customer\Domain\Model\Invite\InvitationCriteria;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /** @test */
    public function shouldBeInvitedBecauseDependingUponAnApprovedCriteria()
    {
        $criteria = $this->givenASatisfiedCriteria(true);
        $customer = $this->givenACustomer();
        $this->assertTrue($customer->isInvited($criteria));
    }
    /** @test */
    public function shouldNotBeInvitedBecauseDependingUponARefusedCriteria()
    {
        $criteria = $this->givenASatisfiedCriteria(false);
        $customer = $this->givenACustomer();
        $this->assertFalse($customer->isInvited($criteria));
    }

    private function givenASatisfiedCriteria(bool $mock_return)
    {
        $mock = $this->getMockBuilder(InvitationCriteria::class)->disableOriginalConstructor()->getMock();
        $mock->method('isSatisfiedBy')->willReturn($mock_return);
        return $mock;
    }

    private function givenACustomer(): Customer
    {
        return Customer::instance(2, 'Marcos', 52.98, -6.043);
    }
}
