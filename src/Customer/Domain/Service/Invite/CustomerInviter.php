<?php

namespace CustomerRecords\Customer\Domain\Service\Invite;

use CustomerRecords\Customer\Domain\Model\Customer\Customer;
use CustomerRecords\Customer\Domain\Model\Customer\CustomerCollection;
use CustomerRecords\Customer\Domain\Model\Customer\CustomerRepository;
use CustomerRecords\Customer\Domain\Model\Invite\InvitationCriteria;

final class CustomerInviter
{
    private $customer_repository;

    public function __construct(CustomerRepository $a_customer_repository)
    {
        $this->customer_repository = $a_customer_repository;
    }

    public function __invoke(InvitationCriteria $an_invitation_criteria): CustomerCollection
    {
        $customer_collection = $this->customer_repository->findAll();
        /** @var Customer $current_customer */
        foreach ($customer_collection->customers() as $current_customer) {
            if(!$current_customer->isInvited($an_invitation_criteria))
            {
                $customer_collection->removeCustomer($current_customer->customerId());
            }
        }

        $customer_collection->sortBy(CustomerCollection::SORT_ASC);

        return $customer_collection;
    }
}
