<?php

declare(strict_types=1);

namespace Web3\Formatters;

use Web3\Contracts\Formatter;

/**
 * @internal
 *
 * @implements Formatter<array<string, string>, array<string, string>>
 */
final class ArrayToTransactionCall implements Formatter
{
    /**
     * {@inheritDoc}
     *
     * @param array<string, string> $value
     *
     * @return array<string, string>
     */
    public static function format(array $value): array
    {
        // @todo

        return $value;
    }
}
