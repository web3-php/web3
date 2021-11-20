<?php

declare(strict_types=1);

namespace Web3;

use GuzzleHttp\Client;
use Web3\Contracts\Transporter;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;
use Web3\Namespaces\Db;
use Web3\Namespaces\Eth;
use Web3\Namespaces\Net;
use Web3\Namespaces\Shh;
use Web3\Transporters\Http;

/**
 * @mixin Namespaces\Web3
 */
final class Web3
{
    /**
     * The Transporter instance.
     */
    private ?Transporter $transporter = null;

    /**
     * Creates a new Web3 instance.
     */
    public function __construct(private string $url)
    {
        // ..
    }

    /**
     * Creates a new Db instance.
     */
    public function db(): Db
    {
        return new Db($this->getTransporter());
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
     * Creates a new Shh instance.
     */
    public function shh(): Shh
    {
        return new Shh($this->getTransporter());
    }

    /**
     * Sets the Web3 instance Transporter.
     */
    public function setTransporter(Transporter $transporter): void
    {
        $this->transporter = $transporter;
    }

    /**
     * Gets a new Transporter instance.
     */
    private function getTransporter(): Transporter
    {
        return $this->transporter ?: new Http(new Client(), $this->url);
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
        return (new Namespaces\Web3($this->getTransporter()))->{$method}();
    }
}
