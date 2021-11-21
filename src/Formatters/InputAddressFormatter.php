<?php

declare(strict_types=1);

namespace Web3\Formatters;

use Web3\Contracts\Formatter;

/**
 * @internal
 *
 * @implements Formatter<string>
 */
final class InputAddressFormatter implements Formatter
{
    /**
     * @param string $value
     *
     * @return string
     */
    public static function format(mixed $value): mixed
    {
        return $value;
    }
}
