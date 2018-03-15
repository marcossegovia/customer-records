<?php

namespace CustomerRecords\Customer\Domain\Model\Customer;

final class CustomerId
{
    private $id;

    public function __construct(int $an_id)
    {
        $this->id = $an_id;
    }

    public function id(): int
    {
        return $this->id;
    }
}
