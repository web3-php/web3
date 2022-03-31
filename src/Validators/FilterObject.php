<?php

declare(strict_types=1);

namespace Web3\Validators;

use Web3\Contracts\Validator;
use Web3\Exceptions\ValidatorException;

final class FilterObject implements Validator
{
    /**
     * Validates a filter object.
     *
     * @param array<string, string|array<string>> $arg
     * @param array $config
     *
     * @throws ValidatorException
     *
     * @return bool
     */
    public static function validate($arg, array $config = []): bool
    {
        if (!is_array($arg)) {
            throw new ValidatorException('Expected FilterObject to be an array.');
        }

        if (isset($arg['topics']) && !is_array($arg['topics'])) {
            throw new ValidatorException('Expected FilterObject topics to be an array.');
        }

        foreach (['address', 'fromBlock', 'toBlock', 'blockhash'] as $key) {
            if (isset($arg[$key]) && !is_string($arg[$key])) {
                throw new ValidatorException("Expected FilterObject $key value to be string.");
            }
        }

        return true;
    }
}
