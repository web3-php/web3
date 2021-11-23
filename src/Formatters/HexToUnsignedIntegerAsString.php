<?php

declare(strict_types=1);

namespace Web3\Formatters;

use Web3\Contracts\Formatter;

/**
 * @internal
 *
 * @implements Formatter<string, string>
 */
final class HexToUnsignedIntegerAsString implements Formatter
{
    /**
     * {@inheritDoc}
     */
    public static function format(string $value): string
    {
        $value = hexdec($value);

        if (is_int($value)) {
            return (string) $value;
        }

        return number_format($value, 0, ',', '');
    }
}
