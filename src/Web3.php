<?php

declare(strict_types=1);

namespace Web3;

use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;
use Web3\Namespaces\Eth;
use Web3\Namespaces\Net;

/**
 * @mixin Namespaces\Web3
 */
final class Web3
{
    use Concerns\Transportable;

    /**
     * Creates a new Web3 instance.
     */
    public function __construct(private string $url)
    {
        // ..
    }

    /**
     * Creates a new Eth instance.
     */
    public function eth(): Eth
    {
        return new Eth($this->getTransporter());
    }

    /**
     * Creates a new Net instance.
     */
    public function net(): Net
    {
        return new Net($this->getTransporter());
    }

    /**
     * Dynamically handle calls to the namespace.
     *
     * @param array<int, array<string, string>> $params
     *
     * @throws ErrorException|TransporterException
     *
     * @return array<array-key, mixed>|string|bool
     */
    public function __call(string $method, array $params = []): array|string|bool
    {
        return (new Namespaces\Web3($this->getTransporter()))->{$method}(...$params);
    }
}
