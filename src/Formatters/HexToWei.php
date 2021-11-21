<?php

declare(strict_types=1);

namespace Web3\Formatters;

use Web3\Contracts\Formatter;
use Web3\ValueObjects\Wei;

/**
 * @internal
 *
 * @implements Formatter<string, Wei>
 */
final class HexToWei implements Formatter
{
    /**
     * {@inheritDoc}
     */
    public static function format(string $value): Wei
    {
        return Wei::fromHex($value);
    }
}
