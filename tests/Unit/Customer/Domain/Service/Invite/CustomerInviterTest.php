<?php

namespace CustomerRecordsTest\Unit\Customer\Domain\Service\Invite;

use CustomerRecords\Customer\Domain\Model\Customer\Customer;
use CustomerRecords\Customer\Domain\Model\Customer\CustomerCollection;
use CustomerRecords\Customer\Domain\Model\Customer\CustomerRepository;
use CustomerRecords\Customer\Domain\Model\Invite\InvitationCriteria;
use CustomerRecords\Customer\Domain\Service\Invite\CustomerInviter;
use PHPUnit\Framework\TestCase;

class CustomerInviterTest extends TestCase
{
    /** @test */
    public function shouldReturnCustomerCollectionEmptyWhenNoOneMatchesTheCriteria()
    {
        $customer_repository = $this->havingACustomerRepository();
        $criteria = $this->givenASatisfiedCriteria(false);
        $customer_collection = $this->whenExecutingTheCustomerInviter($customer_repository, $criteria);
        $this->assertEmpty($customer_collection->customers());
    }

    /** @test */
    public function shouldReturnAllCustomersWhenTheCriteriaHasApprovedEverybody()
    {
        $customer_repository = $this->havingACustomerRepository();
        $criteria = $this->givenASatisfiedCriteria(true);
        $customer_collection = $this->whenExecutingTheCustomerInviter($customer_repository, $criteria);
        $this->assertNotEmpty($customer_collection->customers());
        $this->assertCount(5, $customer_collection->customers());
    }

    private function havingACustomerRepository(): CustomerRepository
    {
        $customer_collection = new CustomerCollection();
        $customers = [
            Customer::instance(2, 'Marcos', 52.98, -6.043),
            Customer::instance(15, 'Dave', 60, -2.043),
            Customer::instance(3, 'Richard Fin', 60, 0.043),
            Customer::instance(20, 'Morty', 60, 20.045553),
            Customer::instance(1, 'Rick', 60, -10.3)
        ];
        foreach ($customers as $customer) {
            $customer_collection->addCustomer($customer);
        }
        $mock = $this->getMockBuilder(CustomerRepository::class)->disableOriginalConstructor()->getMock();
        $mock->method('findAll')->willReturn($customer_collection);

        return $mock;
    }

    private function givenASatisfiedCriteria(bool $mock_return)
    {
        $mock = $this->getMockBuilder(InvitationCriteria::class)->disableOriginalConstructor()->getMock();
        $mock->method('isSatisfiedBy')->willReturn($mock_return);

        return $mock;
    }

    private function whenExecutingTheCustomerInviter(CustomerRepository $customer_repository, InvitationCriteria $criteria): CustomerCollection
    {
        $customer_inviter = new CustomerInviter($customer_repository);
        return $customer_inviter->__invoke($criteria);
    }
}
