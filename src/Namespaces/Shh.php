<?php

declare(strict_types=1);

namespace Web3\Namespaces;

use Web3\Concerns\Requestable;

/**
 * @method string post(array $params)
 * @method string version()
 * @method string newIdentity()
 * @method bool   hasIdentity(array $params)
 * @method string newGroup()
 * @method bool   addToGroup(array $params)
 * @method string newFilter(array $params)
 * @method bool   uninstallFilter(array $params)
 * @method array  getFilterChanges(array $params)
 * @method array  getMessages(array $params)
 *
 * @internal
 */
final class Shh
{
    use Requestable;
}
