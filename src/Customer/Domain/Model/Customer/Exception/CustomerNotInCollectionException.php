<?php

namespace CustomerRecords\Customer\Domain\Model\Customer\Exception;

final class CustomerNotInCollectionException extends \RuntimeException
{
    protected $message = 'You are trying to remove a user who is not in the customer collection.';
}
