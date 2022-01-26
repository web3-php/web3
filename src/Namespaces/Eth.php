<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Contracts\Transporter;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;
use Web3\Formatters\BigIntegerToHex;
use Web3\Formatters\HexToBigInteger;
use Web3\Formatters\HexToWei;
use Web3\ValueObjects\Transaction;
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

        return HexToBigInteger::format($result);
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
     * Returns the number of transactions in a block by its hash.
     *
     * @throws ErrorException|TransporterException
     */
    public function getBlockTransactionCountByHash(string $blockHash): string
    {
        $result = $this->transporter->request('eth_getBlockTransactionCountByHash', [
            $blockHash,
        ]);

        assert(is_string($result));

        return HexToBigInteger::format($result);
    }

    /**
     * Returns the number of transactions in a block by its number or identifier.
     *
     * @throws ErrorException|TransporterException
     */
    public function getBlockTransactionCountByNumber(string|int $blockIdentifier): string
    {
        if (is_int($blockIdentifier)) {
            $blockIdentifier = BigIntegerToHex::format((string) $blockIdentifier);
        }

        $result = $this->transporter->request('eth_getBlockTransactionCountByNumber', [
            $blockIdentifier,
        ]);

        assert(is_string($result));

        return HexToBigInteger::format($result);
    }

    /**
     * Returns information about a transaction by its hash.
     *
     * @return array<string, string>
     *
     * @throws ErrorException|TransporterException
     */
    public function getTransactionByHash(string $transactionHash): array
    {
        $result = $this->transporter->request('eth_getTransactionByHash', [
            $transactionHash,
        ]);

        /** @var array<string, string> $result */
        assert(is_array($result));

        foreach (['blockNumber', 'gas', 'gasPrice', 'nonce', 'transactionIndex', 'value', 'v'] as $key) {
            $result[$key] = HexToBigInteger::format($result[$key]);
        }

        return $result;
    }

    /**
     * Returns the receipt of a transaction by its hash.
     * Note that the receipt is not available for pending transactions.
     *
     * @return array<string, string|array<string, string>>
     *
     * @throws ErrorException|TransporterException
     */
    public function getTransactionReceipt(string $transactionHash): array
    {
        $result = $this->transporter->request('eth_getTransactionReceipt', [
            $transactionHash,
        ]);

        /** @var array<string, string|array<string, string>> $result */
        assert(is_array($result));

        foreach (['blockNumber', 'cumulativeGasUsed', 'gasUsed', 'status', 'transactionIndex'] as $key) {
            assert(is_string($result[$key]));

            $result[$key] = HexToBigInteger::format($result[$key]);
        }

        assert(is_array($result['logs']));

        /** @var array<string, string> $log */
        foreach ($result['logs'] ?? [] as $logKey => $log) {
            foreach (['blockNumber', 'logIndex', 'transactionIndex'] as $key) {
                $result['logs'][$logKey][$key] = HexToBigInteger::format($log[$key]);
            }
        }

        return $result;
    }

    /**
     * Returns the number of uncles in a block by its hash.
     *
     * @throws ErrorException|TransporterException
     */
    public function getUncleCountByBlockHash(string $blockHash): string
    {
        $result = $this->transporter->request('eth_getUncleCountByBlockHash', [
            $blockHash,
        ]);

        assert(is_string($result));

        return HexToBigInteger::format($result);
    }

    /**
     * Returns the number of hashes-per-second this node is mining at.
     *
     * @throws ErrorException|TransporterException
     */
    public function hashrate(): string
    {
        $result = $this->transporter->request('eth_hashrate');

        assert(is_string($result));

        return HexToBigInteger::format($result);
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

        return HexToBigInteger::format($result);
    }

    /**
     * Returns the coinbase address of the client.
     *
     * @throws ErrorException|TransporterException
     */
    public function coinbase(): string
    {
        $result = $this->transporter->request('eth_coinbase');

        assert(is_string($result));

        return $result;
    }

    /**
     * Creates, signs, and sends a new transaction to the network.
     *
     * @throws ErrorException|TransporterException
     */
    public function sendTransaction(Transaction $transaction): string
    {
        $result = $this->transporter->request('eth_sendTransaction', $transaction->toArray());

        assert(is_string($result));

        return $result;
    }

    /**
     * Submit a proof-of-work solution.
     *
     * @throws ErrorException|TransporterException
     */
    public function submitWork(string $nonce, string $proofOfWorkHash, string $mixDigest): bool
    {
        $result = $this->transporter->request('eth_submitWork', [
            $nonce,
            $proofOfWorkHash,
            $mixDigest,
        ]);

        assert(is_bool($result));

        return $result;
    }
}
