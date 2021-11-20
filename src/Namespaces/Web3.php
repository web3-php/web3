<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Concerns\Requestable;

/**
 * @method string clientVersion()
 * @method string sha3(array $params)
 *
 * @internal
 */
final class Web3
{
    use Requestable;
}
