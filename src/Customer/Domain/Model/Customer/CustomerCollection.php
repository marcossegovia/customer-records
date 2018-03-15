<?php

namespace CustomerRecords\Customer\Domain\Model\Customer;

use CustomerRecords\Customer\Domain\Model\Customer\Exception\CustomerAlreadyInCollectionException;
use CustomerRecords\Customer\Domain\Model\Customer\Exception\CustomerNotInCollectionException;

final class CustomerCollection
{
    public const SORT_ASC = 0;
    public const SORT_DESC = 1;

    private $customers;

    public function __construct()
    {
        $this->customers = [];
    }

    public function addCustomer(Customer $a_customer): void
    {
        if(isset($this->customers[$a_customer->customerId()->id()]))
        {
            throw new CustomerAlreadyInCollectionException();
        }
        $this->customers[$a_customer->customerId()->id()] = $a_customer;
    }

    public function removeCustomer(CustomerId $a_customer_id): void
    {
        if(!isset($this->customers[$a_customer_id->id()]))
        {
            throw new CustomerNotInCollectionException();
        }
        unset($this->customers[$a_customer_id->id()]);
    }

    public function sortBy(int $a_sort = self::SORT_ASC): void
    {
        if (self::SORT_ASC === $a_sort) {
            \ksort($this->customers);

        } else {
            \krsort($this->customers);
        }
    }

    public function customers(): array
    {
        return $this->customers;
    }
}
