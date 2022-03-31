<?php

declare(strict_types=1);

namespace Web3\Contracts;

/**
 * @template TArgumentValue
 *
 * @method static bool validate(TArgumentValue $value)
 *
 * @internal
 */
interface Validator
{
    /**
     * Validates an argument.
     *
     * @param mixed $arg
     * @param array $config
     *
     * @throws ErrorException|ValidatorException
     *
     * @return bool
     */
    public static function validate($arg, array $config): bool;
}
