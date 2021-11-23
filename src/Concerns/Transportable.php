<?php

declare(strict_types=1);

namespace Web3\Concerns;

use GuzzleHttp\Client;
use Web3\Contracts\Transporter;
use Web3\Exceptions\InvalidUrlException;
use Web3\Transporters\Http;

/**
 * @internal
 *
 * @depends \Web3\Web3
 */
trait Transportable
{
    /**
     * The Transporter instance.
     */
    private ?Transporter $transporter = null;

    /**
     * Gets a new Transporter instance.
     */
    private function getTransporter(): Transporter
    {
        if (!is_null($this->transporter)) {
            return $this->transporter;
        }

        if (str_starts_with($this->url, '127')) {
            $this->transporter = new Http(new Client(), sprintf('http://%s', $this->url));
        }

        if (str_starts_with($this->url, 'http')) {
            $this->transporter = new Http(new Client(), $this->url);
        }

        if (is_null($this->transporter)) {
            throw new InvalidUrlException('The given url must start by "http".');
        }

        return $this->transporter;
    }
}
