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
}
