<?php

namespace CustomerRecords\Customer\Infrastructure\ExternalApi\Github\Customer;

use CustomerRecords\Customer\Domain\Infrastructure\HttpClient;
use CustomerRecords\Customer\Domain\Model\Core\Http\Request;
use CustomerRecords\Customer\Domain\Model\Core\Http\Response;
use CustomerRecords\Customer\Domain\Model\Customer\Customer;
use CustomerRecords\Customer\Domain\Model\Customer\CustomerCollection;
use CustomerRecords\Customer\Domain\Model\Customer\CustomerRepository as CustomerRepositoryInterface;
use CustomerRecords\Customer\Domain\Model\Customer\Exception\CustomersAreNotAvailableException;

final class CustomerRepository implements CustomerRepositoryInterface
{
    private const BASE_URL = 'https://gist.githubusercontent.com';
    private const USERNAME = 'brianw';
    private const GIST_ID = '19896c50afa89ad4dec3';

    private $http_client;

    public function __construct(HttpClient $a_http_client)
    {
        $this->http_client = $a_http_client;
    }

    public function findAll(): CustomerCollection
    {
        $request = $this->http_client->createRequest(Request::GET, self::BASE_URL . '/' . self::USERNAME . '/' . self::GIST_ID . '/raw/', true);
        $response = $this->http_client->execute($request);

        if (Response::STATUS_CODE['OK'] !== $response->statusCode()) {
            throw new CustomersAreNotAvailableException($response->reason(), $response->statusCode());
        }

        $fixed_response = $this->fixJsonResponse($response->body()[0]);
        $customers_from_response = \json_decode($fixed_response, true);

        return $this->hydrateCustomers($customers_from_response['customers']);
    }

    private function fixJsonResponse(string $body_response): string
    {
        $result = preg_replace('/(\n)/', ',', $body_response);
        return '{"customers":[' . $result . ']}';
    }

    private function hydrateCustomers(array $customers_from_response): CustomerCollection
    {
        $customer_collection = new CustomerCollection();
        foreach ($customers_from_response as $current_customer) {
            $customer = Customer::instance($current_customer['user_id'], $current_customer['name'], $current_customer['latitude'], $current_customer['longitude']);
            $customer_collection->addCustomer($customer);
        }
        return $customer_collection;
    }
}
