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
        return '0x' . bin2hex($value);
    }
}
