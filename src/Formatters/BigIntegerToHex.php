<?php

declare(strict_types=1);

namespace Web3\Formatters;

use phpseclib3\Math\BigInteger;
use Web3\Contracts\Formatter;

/**
 * @internal
 *
 * @implements Formatter<string, string>
 */
final class BigIntegerToHex implements Formatter
{
    /**
     * {@inheritDoc}
     */
    public static function format(string $value): string
    {
        if (str_starts_with($value, '0x')) {
            return $value;
        }

        $bigInteger = new BigInteger($value);

        return '0x' . $bigInteger->toHex();
    }
}
