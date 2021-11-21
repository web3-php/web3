<?php

declare(strict_types=1);

namespace Web3\Formatters;

use Web3\Contracts\Formatter;

/**
 * @internal
 *
 * @implements Formatter<string>
 */
final class OutputIntegerFormatter implements Formatter
{
    /**
     * {@inheritDoc}
     */
    public static function format(string $value): string
    {
        return (string) hexdec($value);
    }
}
