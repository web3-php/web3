<?php

declare(strict_types=1);

namespace Web3\Contracts;

/**
 * @template TValue
 *
 * @internal
 */
interface Formatter
{
    /**
     * Formats the given value.
     *
     * @param TValue $value
     *
     * @return TValue
     */
    public static function format(mixed $value): mixed;
}
