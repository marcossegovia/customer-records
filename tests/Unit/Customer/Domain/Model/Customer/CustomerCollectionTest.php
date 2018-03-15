<?php

namespace CustomerRecordsTest\Unit\Customer\Domain\Model\Customer;

use CustomerRecords\Customer\Domain\Model\Customer\Customer;
use CustomerRecords\Customer\Domain\Model\Customer\CustomerCollection;
use CustomerRecords\Customer\Domain\Model\Customer\Exception\CustomerAlreadyInCollectionException;
use CustomerRecords\Customer\Domain\Model\Customer\Exception\CustomerNotInCollectionException;
use PHPUnit\Framework\TestCase;

class CustomerCollectionTest extends TestCase
{
    /** @var CustomerCollection */
    private $customer_collection;

    public function setUp()
    {
        $this->customer_collection = new CustomerCollection();
    }

    /** @test */
    public function shouldContainAndRetrieveTheSameAmountOfCustomers()
    {
        $customers = $this->havingAnArrayOfCustomers();
        $this->whenAddingAllCustomersToTheCollection($customers);
        $this->shouldGetTheSameAmountOfCustomers(\count($customers));
    }

    /** @test */
    public function shouldBeAbleToRetrieveTheCustomersSortedAsc()
    {
        $customers = $this->havingAnArrayOfCustomers();
        $this->whenAddingAllCustomersToTheCollection($customers);
        $this->whenSortingCustomerCollection(CustomerCollection::SORT_ASC);
        $this->shouldRetrieveTheArrayOfCustomersSortedInAscendingOrder();
    }

    /** @test */
    public function shouldBeAbleToRetrieveTheCustomersSortedDesc()
    {
        $customers = $this->havingAnArrayOfCustomers();
        $this->whenAddingAllCustomersToTheCollection($customers);
        $this->whenSortingCustomerCollection(CustomerCollection::SORT_DESC);
        $this->shouldRetrieveTheArrayOfCustomersSortedInDescendingOrder();
    }

    /** @test */
    public function shouldExpectExceptionWhenTryingToAddAnAlreadyAddedUser()
    {
        $customers = $this->havingAnArrayOfCustomers();
        $this->whenAddingAllCustomersToTheCollection($customers);
        $this->shouldExpectAnExceptionOfType(CustomerAlreadyInCollectionException::class);
        $this->whenTryingToAddAgainAnExistingCustomer($customers[0]);
    }

    /** @test */
    public function shouldExpectExceptionWhenTryingToRemoveANonExistentUser()
    {
        $customers = $this->havingAnArrayOfCustomers();
        $this->whenAddingAllCustomersToTheCollection($customers);
        $this->shouldExpectAnExceptionOfType(CustomerNotInCollectionException::class);
        $this->whenTryingToRemoveANonExistingCustomer(Customer::instance(60, 'Mark', 52.98, -6.043));
    }

    private function havingAnArrayOfCustomers(): array
    {
        return [
            Customer::instance(2, 'Marcos', 52.98, -6.043),
            Customer::instance(15, 'Dave', 60, -2.043),
            Customer::instance(3, 'Richard Fin', 60, 0.043),
            Customer::instance(20, 'Morty', 60, 20.045553),
            Customer::instance(1, 'Rick', 60, -10.3),
        ];
    }

    private function whenAddingAllCustomersToTheCollection(array $customers): void
    {
        foreach ($customers as $customer) {
            $this->customer_collection->addCustomer($customer);
        }
    }

    private function whenSortingCustomerCollection(int $sort)
    {
        $this->customer_collection->sortBy($sort);
    }

    private function whenTryingToAddAgainAnExistingCustomer(Customer $customer): void
    {
        $this->customer_collection->addCustomer($customer);
    }

    private function whenTryingToRemoveANonExistingCustomer(Customer $customer): void
    {
        $this->customer_collection->removeCustomer($customer->customerId());
    }

    private function shouldGetTheSameAmountOfCustomers(int $amount)
    {
        $this->assertCount($amount, $this->customer_collection->customers());
    }

    private function shouldRetrieveTheArrayOfCustomersSortedInAscendingOrder()
    {
        $expected_customers = [
            1 => Customer::instance(1, 'Rick', 60, -10.3),
            2 => Customer::instance(2, 'Marcos', 52.98, -6.043),
            3 => Customer::instance(3, 'Richard Fin', 60, 0.043),
            15 => Customer::instance(15, 'Dave', 60, -2.043),
            20 => Customer::instance(20, 'Morty', 60, 20.045553),
        ];
        $actual_customers = $this->customer_collection->customers();
        while (!empty($expected_customers)) {
            $expected_customer = \array_pop($expected_customers);
            $actual_customer = \array_pop($actual_customers);
            $this->assertEquals($expected_customer, $actual_customer);
        }
    }

    private function shouldRetrieveTheArrayOfCustomersSortedInDescendingOrder()
    {
        $expected_customers = [
            20 => Customer::instance(20, 'Morty', 60, 20.045553),
            15 => Customer::instance(15, 'Dave', 60, -2.043),
            3 => Customer::instance(3, 'Richard Fin', 60, 0.043),
            2 => Customer::instance(2, 'Marcos', 52.98, -6.043),
            1 => Customer::instance(1, 'Rick', 60, -10.3),
        ];
        $actual_customers = $this->customer_collection->customers();
        while (!empty($expected_customers)) {
            $expected_customer = \array_pop($expected_customers);
            $actual_customer = \array_pop($actual_customers);
            $this->assertEquals($expected_customer, $actual_customer);
        }
    }

    private function shouldExpectAnExceptionOfType($exception)
    {
        $this->expectException($exception);
    }
}
