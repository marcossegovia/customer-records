<?php

namespace CustomerRecords\Customer\Domain\Model\Invite;

use CustomerRecords\Customer\Domain\Model\Customer\Customer;

interface InvitationCriteria
{
    public function isSatisfiedBy(Customer $a_customer): bool;
}
