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

    /**
     * The Namespace Formatters API.
     *
     * @var array<string, array{0: array<int, array<int, class-string>>, 1: array<int, class-string>}>
     *
     * @todo https://github.com/ChainSafe/web3.js/blob/a1c7d71973ec17f9287fbea8939e64a80e589fc6/packages/web3-eth/src/index.js#L369
     */
    private static array $api = [];
}
