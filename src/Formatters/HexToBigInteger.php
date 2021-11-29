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
final class HexToBigInteger implements Formatter
{
    /**
     * {@inheritDoc}
     */
    public static function format(string $value): string
    {
        $bigInteger = new BigInteger($value, 16);

        return $bigInteger->toString();
    }
}
