<?php

declare(strict_types=1);

namespace Web3\ValueObjects;

use Web3\Formatters\StringToHex;

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
        foreach (['value'] as $option) {
            if (array_key_exists($option, $options)) {
                $options[$option] = StringToHex::format($options[$option]);
            }
        }

        return new self($from, $to, $options);
    }

    /**
     * Creates a new Transaction instance with the given value.
     */
    public function withValue(Wei $wei): self
    {
        return self::between($this->from, $this->to, array_merge($this->options, [
            'value' => $wei->value(),
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
            'from'  => $this->from,
            'to'    => $this->to,
            'value' => $this->options['value'] ?? null,
        ]);
    }
}
