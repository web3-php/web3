<?php

declare(strict_types=1);

namespace Web3\Contracts;

use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;

/**
 * @internal
 */
interface Transporter
{
    /**
     * Sends a request to a server.
     *
     * @param array<array-key, mixed> $params
     *
     * @throws ErrorException|TransporterException
     *
     * @return array<array-key, mixed>|string|bool
     */
    public function request(string $method, array $params = []): array|string|bool;
}
