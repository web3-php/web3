<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Contracts\Transporter;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;

final class Web3
{
    /**
     * Creates a new Web3 instance.
     */
    public function __construct(private Transporter $transporter)
    {
        // ..
    }

    /**
     * Returns the version of the current client.
     *
     * @throws ErrorException|TransporterException
     */
    public function clientVersion(): string
    {
        $result = $this->transporter->request('web3_clientVersion');

        assert(is_string($result));

        return $result;
    }
}
