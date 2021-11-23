<?php

declare(strict_types=1);

namespace Web3\Formatters;

use Web3\Contracts\Formatter;

/**
 * @internal
 *
 * @implements Formatter<string, string>
 */
final class HexToInt implements Formatter
{
    /**
     * {@inheritDoc}
     */
    public static function format(string $value): int
    {
        $value = hexdec($value);

        assert(is_int($value));

        return $value;
    }
}
