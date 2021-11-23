<?php

declare(strict_types=1);

namespace Web3\ValueObjects;

use Stringable;
use Web3\Formatters\HexToInt;

final class Wei implements Stringable
{
    /**
     * Creates a new Wei instance.
     */
    public function __construct(private string $value)
    {
        // ..
    }

    /**
     * Creates a new Wei instance, from the given hex value.
     */
    public static function fromHex(string $hex): self
    {
        $value = HexToInt::format($hex);

        return new self((string) $value);
    }

    /**
     * Gets the Wei's value.
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * Gets Wei's value.
     */
    public function toWei(): string
    {
        return $this->value();
    }

    /**
     * Gets Wei's Kwei value.
     */
    public function toKwei(): string
    {
        return $this->format(1000);
    }

    /**
     * Gets Wei's Mwei value.
     */
    public function toMwei(): string
    {
        return $this->format(1000000);
    }

    /**
     * Gets Wei's Gwei value.
     */
    public function toGwei(): string
    {
        return $this->format(1000000000);
    }

    /**
     * Gets the  tWei's ther value.
     */
    public function toMicroether(): string
    {
        return $this->format(1000000000000);
    }

    /**
     * Gets the  tWei's ther value.
     */
    public function toMilliether(): string
    {
        return $this->format(1000000000000000);
    }

    /**
     * Gets tWei's ther value.
     */
    public function toEther(): string
    {
        return $this->format(1000000000000000000);
    }

    /**
     * Gets Wei's Eth value.
     */
    public function toEth(): string
    {
        return $this->toEther();
    }

    /**
     * Gets the Wei's string representation.
     */
    public function toString(): string
    {
        return (string) $this->value();
    }

    /**
     * Gets the Wei's string representation.
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Formats the current value by the given multiplier.
     */
    private function format(int $multiplier): string
    {
        $value = number_format(
            (int) ($this->value()) / $multiplier,
            strlen((string) $multiplier),
            '.',
            ''
        );

        if (str_contains($value, '.')) {
            $value = rtrim($value, '0');
            $value = rtrim($value, '.');
        }

        return $value;
    }
}
