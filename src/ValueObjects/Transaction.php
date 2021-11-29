<?php

declare(strict_types=1);

namespace Web3\ValueObjects;

use Web3\Formatters\BigIntegerToHex;

final class Transaction
{
    /**
     * Creates a new Transaction instance.
     *
     * @param array<string, string> $options
     */
    private function __construct(
        private string $from, private string $to, private array $options,
    ) {
        // ..
    }

    /**
     * Creates a new Transaction instance between the given accounts.
     *
     * @param array<string, string> $options
     */
    public static function between(string $from, string $to, array $options = []): self
    {
        foreach (['value', 'gas', 'gasPrice', 'nonce'] as $option) {
            if (array_key_exists($option, $options)) {
                $options[$option] = BigIntegerToHex::format($options[$option]);
            }
        }

        return new self($from, $to, $options);
    }

    /**
     * Creates a new Transaction instance with the given value in wei.
     */
    public function withValue(Wei $wei): self
    {
        return self::between($this->from, $this->to, array_merge($this->options, [
            'value' => $wei->value(),
        ]));
    }

    /**
     * Creates a new Transaction instance with the given gas in wei.
     *
     * Gas is the gas provided for transaction execution.
     */
    public function withGas(string $quantity): self
    {
        return self::between($this->from, $this->to, array_merge($this->options, [
            'gas' => $quantity,
        ]));
    }

    /**
     * Creates a new Transaction instance with the given gas price in wei.
     *
     * Gas Price is the price in wei of each gas used.
     */
    public function withGasPrice(Wei $wei): self
    {
        return self::between($this->from, $this->to, array_merge($this->options, [
            'gasPrice' => $wei->value(),
        ]));
    }

    /**
     * Creates a new Transaction instance with the given nonce.
     *
     * Nonce is the unique number identifying this transaction.
     */
    public function withNonce(string $number): self
    {
        return self::between($this->from, $this->to, array_merge($this->options, [
            'nonce' => $number,
        ]));
    }

    /**
     * Returns the array representation of the Transaction.
     *
     * @return array<string, string>
     *
     * @internal
     */
    public function toArray(): array
    {
        return array_filter([
            'from'     => $this->from,
            'to'       => $this->to,
            'value'    => $this->options['value'] ?? null,
            'gas'      => $this->options['gas'] ?? null,
            'gasPrice' => $this->options['gasPrice'] ?? null,
            'nonce'    => $this->options['nonce'] ?? null,
        ]);
    }
}
