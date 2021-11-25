<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Contracts\Transporter;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;
use Web3\Formatters\HexToUnsignedIntegerAsString;
use Web3\Formatters\HexToWei;
use Web3\ValueObjects\Wei;

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

    /**
     * Returns the current chain id.
     *
     * @throws ErrorException|TransporterException
     */
    public function chainId(): string
    {
        $result = $this->transporter->request('eth_chainId');

        assert(is_string($result));

        return HexToUnsignedIntegerAsString::format($result);
    }

    /**
     * Returns the current price of gas in wei.
     *
     * @throws ErrorException|TransporterException
     */
    public function gasPrice(): Wei
    {
        $result = $this->transporter->request('eth_gasPrice');

        assert(is_string($result));

        return HexToWei::format($result);
    }

    /**
     * Returns the balance of an address in wei.
     *
     * @throws ErrorException|TransporterException
     */
    public function getBalance(string $address, string $defaultBlock = null): Wei
    {
        $result = $this->transporter->request('eth_getBalance', [
            $address,
            $defaultBlock ?: 'latest',
        ]);

        assert(is_string($result));

        return HexToWei::format($result);
    }

    /**
     * Determines if the client is mining new blocks.
     *
     * @throws ErrorException|TransporterException
     */
    public function isMining(): bool
    {
        $result = $this->transporter->request('eth_mining');

        assert(is_bool($result));

        return $result;
    }

    /**
     * Returns the number (quantity) of the most recent block seen by the client.
     *
     * @throws ErrorException|TransporterException
     */
    public function blockNumber(): string
    {
        $result = $this->transporter->request('eth_blockNumber');

        assert(is_string($result));

        return HexToUnsignedIntegerAsString::format($result);
    }
}
