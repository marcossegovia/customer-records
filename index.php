<?php

require __DIR__ . '/vendor/autoload.php';

use CustomerRecords\Customer\Application\Service\GetInvitedCustomersWithinIntercomLocation;
use CustomerRecords\Customer\Application\Service\GetInvitedCustomersWithinLocationRequest;
use CustomerRecords\Customer\Domain\Model\Customer\Customer;
use CustomerRecords\Customer\Domain\Model\Customer\CustomerCollection;

/**
 *  DEPENDENCY INJECTION
 */
$guzzle_client = new \GuzzleHttp\Client();
$http_client = new \CustomerRecords\Customer\Infrastructure\Guzzle\Client($guzzle_client);
$customer_repository = new \CustomerRecords\Customer\Infrastructure\ExternalApi\Github\Customer\CustomerRepository($http_client);
$customer_inviter = new \CustomerRecords\Customer\Domain\Service\Invite\CustomerInviter($customer_repository);
/**
 *
 */

$request = new GetInvitedCustomersWithinLocationRequest(100);
$use_case = new GetInvitedCustomersWithinIntercomLocation($customer_inviter);
$customer_collection = $use_case->__invoke($request);

output($customer_collection);

function output(CustomerCollection $customerCollection)
{
    echo '*****************************************' . PHP_EOL;
    echo 'Customers invited to join Intercom party !' . PHP_EOL;
    /** @var Customer $current_customer */
    foreach ($customerCollection->customers() as $current_customer) {
        echo '- ' . $current_customer->name() . ' ' . $current_customer->customerId()->id() . PHP_EOL;
    }
    echo '*****************************************' . PHP_EOL;
}
