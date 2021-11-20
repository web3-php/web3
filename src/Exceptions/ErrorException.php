<?php

declare(strict_types=1);

namespace Web3\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /**
     * Creates a new ErrorException instance.
     *
     * @see https://eth.wiki/json-rpc/json-rpc-error-codes-improvement-proposal
     *
     * @param array{code: int, message: string} $error
     */
    public function __construct(private array $error)
    {
        parent::__construct($this->message(), $this->code());
    }

    /**
     * Gets the error code.
     */
    public function code(): int
    {
        return (int) $this->error['code'];
    }

    /**
     * Gets the error message.
     */
    public function message(): string
    {
        return $this->error['message'];
    }
}
