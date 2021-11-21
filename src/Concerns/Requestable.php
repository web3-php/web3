<?php

declare(strict_types=1);

namespace Web3\Concerns;

use Web3\Contracts\Formatter;
use Web3\Contracts\Transporter;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;

/**
 * @internal
 */
trait Requestable
{
    /**
     * Creates a new Requestable instance.
     */
    public function __construct(private Transporter $transporter)
    {
        // ..
    }

    /**
     * Dynamically handle calls to the Transporter.
     *
     * @param array<int, array<string, string>> $params
     *
     * @throws ErrorException|TransporterException
     *
     * @return array<array-key, mixed>|string|bool
     */
    public function __call(string $method, array $params = []): array|string|bool
    {
        if (array_key_exists(0, $params) && is_array($params[0])) {
            $params = $params[0];
        }

        if (array_key_exists($method, $this::$api)) {
            foreach ($params as $number => $param) {
                if (array_key_exists($number, $this::$api[$method][0])) {
                    foreach ($this::$api[$method][0][$number] as $formatter) {
                        /* @var Formatter<array<array-key, mixed>|string|bool> $formatter */
                        $params[$number] = $formatter::format($param);
                    }
                }
            }
        }

        $result = $this->transporter->request(
            sprintf('%s_%s', strtolower(basename(str_replace('\\', '/', $this::class))), $method),
            $params,
        );

        if (array_key_exists($method, $this::$api)) {
            foreach ($this::$api[$method][1] as $formatter) {
                /** @var Formatter<array<array-key, mixed>|string|bool> $formatter */
                $result = $formatter::format($result);
            }
        }

        return $result;
    }
}
