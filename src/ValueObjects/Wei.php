<?php

declare(strict_types=1);

namespace Web3\ValueObjects;

use phpseclib3\Math\BigInteger;
use Stringable;
use Web3\Formatters\HexToBigInteger;

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
        $bigInteger = HexToBigInteger::format($hex);

        return new self((string) $bigInteger);
    }

    /**
     * Creates a new Wei instance, from the given eth value.
     */
    public static function fromEth(string $eth): self
    {
        $value = self::mul($eth, 1000000000000000000);

        return new self($value);
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
        return self::div($this->value, 1000);
    }

    /**
     * Gets Wei's Mwei value.
     */
    public function toMwei(): string
    {
        return self::div($this->value, 1000000);
    }

    /**
     * Gets Wei's Gwei value.
     */
    public function toGwei(): string
    {
        return self::div($this->value, 1000000000);
    }

    /**
     * Gets the  tWei's ther value.
     */
    public function toMicroether(): string
    {
        return self::div($this->value, 1000000000000);
    }

    /**
     * Gets the  tWei's ther value.
     */
    public function toMilliether(): string
    {
        return self::div($this->value, 1000000000000000);
    }

    /**
     * Gets tWei's ether value.
     */
    public function toEther(): string
    {
        return self::div($this->value, 1000000000000000000);
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
        return $this->value();
    }

    /**
     * Gets the Wei's string representation.
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Formats the current value by the given divider.
     */
    private static function div(string $value, int $divider): string
    {
        $scale = strlen((string) $divider);

        $value = bcdiv($value, (string) $divider, $scale);

        assert(is_string($value));

        return self::format($value);
    }

    /**
     * Formats the current value by the given multiplier.
     */
    private static function mul(string $value, int $multiplier): string
    {
        $bigInteger = (new BigInteger($value))->multiply(new BigInteger($multiplier));

        return self::format($bigInteger->toString());
    }

    /**
     * Formats the given string, removing trailing zeros.
     */
    private static function format(string $value): string
    {
        if (str_contains($value, '.')) {
            $value = rtrim($value, '0');
        }

        return rtrim($value, '.');
    }
}
