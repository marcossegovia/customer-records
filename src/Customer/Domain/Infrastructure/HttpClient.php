<?php

namespace CustomerRecords\Customer\Domain\Infrastructure;

use CustomerRecords\Customer\Domain\Model\Core\Http\Request;
use CustomerRecords\Customer\Domain\Model\Core\Http\Response;

interface HttpClient
{
    public function createRequest(string $a_method, string $a_url, bool $a_verify_ssl_certificate, ?array $some_headers = null, $a_body = null): Request;

    public function execute(Request $a_request): Response;
}
