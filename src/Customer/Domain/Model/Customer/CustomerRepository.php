<?php

namespace CustomerRecords\Customer\Domain\Model\Customer;

interface CustomerRepository
{
    public function findAll(): CustomerCollection;
}
