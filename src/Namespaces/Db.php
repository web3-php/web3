<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Concerns\Requestable;

/**
 * @method bool   putString(array $params)
 * @method string getString(array $params)
 * @method bool   putHex(array $params)
 * @method string getHex(array $params)
 *
 * @internal
 */
final class Db
{
    use Requestable;

    /**
     * The Namespace Formatters API.
     *
     * @var array<string, array{0: array<int, array<int, class-string>>, 1: array<int, class-string>}>
     *
     * @todo https://github.com/ChainSafe/web3.js/blob/a1c7d71973ec17f9287fbea8939e64a80e589fc6/packages/web3-eth/src/index.js#L369
     */
    private static array $api = [];
}
