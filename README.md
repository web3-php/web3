<p align="center">
    <img src="https://raw.githubusercontent.com/web3-php/art/master/editor-without-bg.png" width="600" alt="Web3 PHP">
    <p align="center">
        <a href="https://github.com/web3-php/web3/actions"><img alt="GitHub Workflow Status (master)" src="https://img.shields.io/github/workflow/status/web3-php/web3/Tests/master"></a>
        <a href="https://packagist.org/packages/web3-php/web3"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/web3-php/web3"></a>
        <a href="https://packagist.org/packages/web3-php/web3"><img alt="Latest Version" src="https://img.shields.io/packagist/v/web3-php/web3"></a>
        <a href="https://packagist.org/packages/web3-php/web3"><img alt="License" src="https://img.shields.io/packagist/l/web3-php/web3"></a>
    </p>
</p>

------
**Web3 PHP** is a supercharged PHP API client that allows you to interact with a generic Ethereum RPC.

> This project is a work-in-progress. Code and documentation are currently under development and are subject to change.

## Get Started

> **Requires [PHP 8.0+](https://php.net/releases/)**

First, install Web3 via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require web3-php/web3
```

Then, interact with a local (**[web3-php/cli](https://github.com/web3-php/cli)**) or remote ethereum node:

```php
use Web3\Web3;

$web3 = new Web3('http://127.0.0.1:8545');

$accounts = $web3->eth()->accounts(); // ['0x54a3259f4f693e4c1e9daa54eb116a0701edc403', ...]
```

## Usage

### `Web3` Namespace

#### `clientVersion`

The `clientVersion` method returns the version of the current client.

```php
$web3->clientVersion(); // TestRPC v2.13.2
```

#### `sha3`

The `sha3` method hashes data using the Keccak-256 algorithm.

```php
$web3->sha3('string'); // 0x2bc897d8156dzd92f46392126434c0dedzb7ee31dcbcfc6s28
```

### `Eth` Namespace

#### `accounts`

The `accounts` method returns a list of addresses owned by this client.

```php
$web3->eth()->accounts(); // ['0x54a3259f4f693e4c1e9daa54eb116a0701edc403', ...]
```

#### `chainId`

The `chainId` method returns the current chain id.

```php
$web3->eth()->chainId(); // 1
```

#### `gasPrice`

The `gasPrice` method returns the current price of gas in wei.

```php
$web3->eth()->gasPrice()->toEth(); // 0.00000002
```

#### `getBalance`

The `getBalance` method returns the balance of an address in wei.

```php
$web3->eth()->getBalance('0x54a3259f4f693e4c1e9daa54eb116a0701edc403')->toEth(); // 100
```

#### `getBlockTransactionCountByHash`

The `getBlockTransactionCountByHash` method returns the number of transactions in a block by its hash.

```php
$web3->eth()->getBlockTransactionCountByHash('0xd2a91777651a08b92d1d9fc701982c79da2249532cfe41a773a340978f96b5d1'); // 266
```

#### `getTransactionByHash`

The `getTransactionByHash` method returns information about a transaction by its hash.

```php
$web3->eth()->getTransactionByHash('0x88df016429689c079f3b2f6ad39fa052532c56795b733da78a91ebe6a713944b');
```

#### `getTransactionReceipt`

The `getTransactionReceipt` method returns the receipt for a transaction by its hash.

```php
$web3->eth()->getTransactionReceipt('0xbb3a336e3f823ec18197f1e13ee875700f08f03e2cab75f0d0b118dabb44cba0');
```

#### `getUncleCountByBlockHash`

The `getUncleCountByBlockHash` method returns the number of uncles in a block by its hash.

```php
$web3->eth()->getUncleCountByBlockHash('0xd2a91777651a08b92d1d9fc701982c79da2249532cfe41a773a340978f96b5d1'); // 266
```

#### `isMining`

The `isMining()` method determines if the client is mining new blocks.

```php
$web3->eth()->isMining(); // true 
```

#### `blockNumber`

The `blockNumber()` method returns the number (quantity) of the most recent block seen by this client.

```php
$web3->eth()->blockNumber(); // '3220' 
```

#### `coinbase`

The `coinbase()` method returns the Coinbase address of the client.

```php
$web3->eth()->coinbase(); // '0xc014ba5ec014ba5ec014ba5ec014ba5ec014ba5e' 
```

#### `sendTransaction`

The `sendTransaction` method creates, signs, and sends a new transaction to the network.

```php
use Web3\ValueObjects\{Transaction, Wei};

$from = '0xc9257b94da7f8eb07537db73a4ad0603cd83aba4';
$to = '0x108d1089e4a737c0be63527a6e464564be948b03';
$value = Wei::fromEth('1');

$transaction = Transaction::between($from, $to)->withValue($value);

$web3->eth()->sendTransaction($transaction); // '0xa124a7de5177cf5cedd3c44e91d115d0011f915905fa36fb7c000a491fa536ee' 
```

### `Net` Namespace

#### `listening`

The `listening` method determines if this client is listening for new network connections.

```php
$web3->net()->listening(); // true
```

#### `peerCount`

The `peerCount` method returns the number of peers currently connected to this client.

```php
$web3->net()->peerCount(); // 230
```

#### `version`

The `version` method returns the chain ID associated with the current network.

```php
$web3->net()->version(); // 1637712995212
```

---

Web3 PHP is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
