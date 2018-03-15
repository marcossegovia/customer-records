<?php

namespace CustomerRecords\Customer\Domain\Model\Customer\Exception;

final class CustomersAreNotAvailableException extends \RuntimeException
{
    public function __construct($reason, $code)
    {
        parent::__construct('The customers repository responded with: ' . $reason . ' (' . $code . ')');
    }
}
