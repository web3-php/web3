<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Concerns\Requestable;

/**
 * @method string version()
 * @method string peerCount()
 * @method bool   listening()
 *
 * @internal
 */
final class Net
{
    use Requestable;
}
