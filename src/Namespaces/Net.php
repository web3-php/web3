<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Contracts\Transporter;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;
use Web3\Formatters\HexToBigInteger;

final class Net
{
    /**
     * Creates a new Db instance.
     */
    public function __construct(private Transporter $transporter)
    {
        // ..
    }

    /**
     * Determines if this client is listening for new network connections.
     *
     * @throws ErrorException|TransporterException
     */
    public function listening(): bool
    {
        $result = $this->transporter->request('net_listening');

        assert(is_bool($result));

        return $result;
    }

    /**
     * Returns the number of peers currently connected to this client.
     *
     * @throws ErrorException|TransporterException
     */
    public function peerCount(): string
    {
        $result = $this->transporter->request('net_peerCount');

        assert(is_string($result));

        return HexToBigInteger::format($result);
    }

    /**
     * Returns the chain ID associated with the current network.
     *
     * @throws ErrorException|TransporterException
     */
    public function version(): string
    {
        $result = $this->transporter->request('net_version');

        assert(is_string($result));

        return $result;
    }
}
