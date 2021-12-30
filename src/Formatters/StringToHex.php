<?php

declare(strict_types=1);

namespace Web3\Formatters;

use Web3\Contracts\Formatter;

/**
 * @internal
 *
 * @implements Formatter<string, string>
 */
final class StringToHex implements Formatter
{
    /**
     * {@inheritDoc}
     */
    public static function format(string $value): string
    {
        if (str_starts_with($value, '0x') && ctype_xdigit(substr($value, 2))) {
            return $value;
        }

        return '0x' . bin2hex($value);
    }
}
