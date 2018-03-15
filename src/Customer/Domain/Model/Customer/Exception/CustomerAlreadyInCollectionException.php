<?php

namespace CustomerRecords\Customer\Domain\Model\Customer\Exception;

final class CustomerAlreadyInCollectionException extends \RuntimeException
{
    protected $message = 'You are trying to add an existent customer into the collection.';
}
