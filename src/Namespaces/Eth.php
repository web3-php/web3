<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Contracts\Transporter;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;

final class Eth
{
    /**
     * Creates a new Eth instance.
     */
    public function __construct(private Transporter $transporter)
    {
        // ..
    }

    /**
     * Returns a list of addresses owned by this client.
     *
     * @return array<int, string>
     *
     * @throws ErrorException|TransporterException
     */
    public function accounts(): array
    {
        $result = $this->transporter->request('eth_accounts');

        /** @var array<int, string> $result */
        assert(is_array($result));

        return $result;
    }
}
