<?php

namespace CustomerRecords\Customer\Application\Service;

use CustomerRecords\Customer\Domain\Model\Customer\CustomerCollection;
use CustomerRecords\Customer\Domain\Model\Invite\Criteria\LocationCriteria;
use CustomerRecords\Customer\Domain\Model\Location\LocationFactory;
use CustomerRecords\Customer\Domain\Service\Invite\CustomerInviter;

final class GetInvitedCustomersWithinIntercomLocation
{
    private $customer_inviter;

    public function __construct(CustomerInviter $a_customer_inviter)
    {
        $this->customer_inviter = $a_customer_inviter;
    }

    public function __invoke(GetInvitedCustomersWithinLocationRequest $a_request): CustomerCollection
    {
        return $this->customer_inviter->__invoke(new LocationCriteria(LocationFactory::intercom(), $a_request->maxDistance()));
    }

}
