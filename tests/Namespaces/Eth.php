<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Eth;
use Web3\ValueObjects\Transaction;
use Web3\ValueObjects\Wei;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->eth = new Eth($this->transporter);
});

test('accounts', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_accounts'
    )->once()->andReturn([
        '0x407d73d8a49eeb85d32cf465507dd71d507100c1',
    ]);

    expect($this->eth->accounts())
        ->toBe(['0x407d73d8a49eeb85d32cf465507dd71d507100c1']);
});

test('chain id', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_chainId'
    )->once()->andReturn('0x1');

    expect($this->eth->chainId())
        ->toBe('1');
});

test('gas price', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_gasPrice'
    )->once()->andReturn('0x400');

    expect($this->eth->gasPrice()->value())
        ->toBe('1024');
});

test('get balance', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_getBalance',
        [
            '0x407d73d8a49eeb85d32cf465507dd71d507100c1',
            'latest',
        ]
    )->once()->andReturn(
        '0x400',
    );

    expect($this->eth->getBalance('0x407d73d8a49eeb85d32cf465507dd71d507100c1')->value())
        ->toBe('1024');
});

test('get block transaction count by hash', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_getBlockTransactionCountByHash',
        [
            '0xd2a91777651a08b92d1d9fc701982c79da2249532cfe41a773a340978f96b5d1',
        ]
    )->once()->andReturn(
        '0x41',
    );

    expect($this->eth->getBlockTransactionCountByHash('0xd2a91777651a08b92d1d9fc701982c79da2249532cfe41a773a340978f96b5d1'))
        ->toBe('65');
});

test('get block transaction count by number', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_getBlockTransactionCountByNumber',
        [
            'latest',
        ]
    )->once()->andReturn(
        '0x41',
    );

    expect($this->eth->getBlockTransactionCountByNumber('latest'))
        ->toBe('65');
});

test('get transaction by hash', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_getTransactionByHash',
        [
            '0x88df016429689c079f3b2f6ad39fa052532c56795b733da78a91ebe6a713944b',
        ]
    )->once()->andReturn([
        'blockHash'        => '0x1d59ff54b1eb26b013ce3cb5fc9dab3705b415a67127a003c3e61eb445bb8df2',
        'blockNumber'      => '0x5daf3b',
        'from'             => '0xa7d9ddbe1f17865597fbd27ec712455208b6b76d',
        'gas'              => '0xc350',
        'gasPrice'         => '0x4a817c800',
        'hash'             => '0x88df016429689c079f3b2f6ad39fa052532c56795b733da78a91ebe6a713944b',
        'input'            => '0x68656c6c6f21',
        'nonce'            => '0x15',
        'r'                => '0x1b5e176d927f8e9ab405058b2d2457392da3e20f328b16ddabcebc33eaac5fea',
        's'                => '0x4ba69724e8f69de52f0125ad8b3c5c2cef33019bac3249e2c0a2192766d1721c',
        'to'               => '0xf02c1c8e6114b1dbe8937a39260b5b0a374432bb',
        'transactionIndex' => '0x41',
        'v'                => '0x25',
        'type'             => 'string',
        'value'            => '0xf3dbb76162000',
    ]);

    expect($this->eth->getTransactionByHash('0x88df016429689c079f3b2f6ad39fa052532c56795b733da78a91ebe6a713944b'))
        ->toBe([
            'blockHash'        => '0x1d59ff54b1eb26b013ce3cb5fc9dab3705b415a67127a003c3e61eb445bb8df2',
            'blockNumber'      => '6139707',
            'from'             => '0xa7d9ddbe1f17865597fbd27ec712455208b6b76d',
            'gas'              => '50000',
            'gasPrice'         => '20000000000',
            'hash'             => '0x88df016429689c079f3b2f6ad39fa052532c56795b733da78a91ebe6a713944b',
            'input'            => '0x68656c6c6f21',
            'nonce'            => '21',
            'r'                => '0x1b5e176d927f8e9ab405058b2d2457392da3e20f328b16ddabcebc33eaac5fea',
            's'                => '0x4ba69724e8f69de52f0125ad8b3c5c2cef33019bac3249e2c0a2192766d1721c',
            'to'               => '0xf02c1c8e6114b1dbe8937a39260b5b0a374432bb',
            'transactionIndex' => '65',
            'v'                => '37',
            'type'             => 'string',
            'value'            => '4290000000000000',
        ]);
});

test('get transaction receipt', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_getTransactionReceipt',
        [
            '0xbb3a336e3f823ec18197f1e13ee875700f08f03e2cab75f0d0b118dabb44cba0',
        ]
    )->once()->andReturn([
        'blockHash'         => '0xc6ef2fc5426d6ad6fd9e2a26abeab0aa2411b7ab17f30a99d3cb96aed1d1055b',
        'contractAddress'   => '0xb60e8dd61c5d32be8058bb8eb970870f07233155',
        'from'              => '0xa7d9ddbe1f17865597fbd27ec712455208b6b76d',
        'logsBloom'         => '0xb903239f8543d04b5dc1ba6579132b143031c68db1b2168786408fcbce568239',
        'to'                => '0xf02c1c8e6114b1dbe8937a39260b5b0a374432bb',
        'transactionHash'   => '0x88df016429689c079f3b2f6ad39fa052532c56795b733da78a91ebe6a713944b',
        'blockNumber'       => '0xb',
        'cumulativeGasUsed' => '0x33bc',
        'gasUsed'           => '0x4dc',
        'status'            => '0x1',
        'transactionIndex'  => '0x1',
        'logs'              => [],
    ]);

    expect($this->eth->getTransactionReceipt('0xbb3a336e3f823ec18197f1e13ee875700f08f03e2cab75f0d0b118dabb44cba0'))
        ->toBe([
            'blockHash'         => '0xc6ef2fc5426d6ad6fd9e2a26abeab0aa2411b7ab17f30a99d3cb96aed1d1055b',
            'contractAddress'   => '0xb60e8dd61c5d32be8058bb8eb970870f07233155',
            'from'              => '0xa7d9ddbe1f17865597fbd27ec712455208b6b76d',
            'logsBloom'         => '0xb903239f8543d04b5dc1ba6579132b143031c68db1b2168786408fcbce568239',
            'to'                => '0xf02c1c8e6114b1dbe8937a39260b5b0a374432bb',
            'transactionHash'   => '0x88df016429689c079f3b2f6ad39fa052532c56795b733da78a91ebe6a713944b',
            'blockNumber'       => '11',
            'cumulativeGasUsed' => '13244',
            'gasUsed'           => '1244',
            'status'            => '1',
            'transactionIndex'  => '1',
            'logs'              => [],
        ]);
});

test('get uncle count by block hash', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_getUncleCountByBlockHash',
        [
            '0xd2a91777651a08b92d1d9fc701982c79da2249532cfe41a773a340978f96b5d1',
        ]
    )->once()->andReturn(
        '0x1',
    );

    expect($this->eth->getUncleCountByBlockHash('0xd2a91777651a08b92d1d9fc701982c79da2249532cfe41a773a340978f96b5d1'))
        ->toBe('1');
});

test('hashrate', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_hashrate'
    )->once()->andReturn('0x41');

    expect($this->eth->hashrate())
        ->toBe('65');
});

test('is mining', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_mining'
    )->once()->andReturn(false);

    expect($this->eth->isMining())
        ->toBe(false);
});

test('block number', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_blockNumber'
    )->once()->andReturn('0xc94');

    expect($this->eth->blockNumber())
        ->toBe('3220');
});

test('coinbase address', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_coinbase'
    )->once()->andReturn('0xc014ba5ec014ba5ec014ba5ec014ba5ec014ba5e');

    expect($this->eth->coinbase())
        ->toBe('0xc014ba5ec014ba5ec014ba5ec014ba5ec014ba5e');
});

test('send transaction', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_sendTransaction',
        [
            'from'     => '0xa7d9ddbe1f17865597fbd27ec712455208b6b76d',
            'to'       => '0xf02c1c8e6114b1dbe8937a39260b5b0a374432bb',
            'value'    => '0x0f3dbb76162000',
            'gas'      => '0xc350',
            'gasPrice' => '0x04a817c800',
            'nonce'    => '0x15',
        ]
    )->once()->andReturn('0xc014ba5ec014ba5ec014ba5ec014ba5ec014ba5e');

    $transaction = Transaction::between(
        '0xa7d9ddbe1f17865597fbd27ec712455208b6b76d',
        '0xf02c1c8e6114b1dbe8937a39260b5b0a374432bb',
    )->withValue(new Wei('4290000000000000'))
        ->withGas('50000')
        ->withGasPrice(new Wei('20000000000'))
        ->withNonce('21');

    expect($this->eth->sendTransaction($transaction))
        ->toBe('0xc014ba5ec014ba5ec014ba5ec014ba5ec014ba5e');
});

test('submit work', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_submitWork', [
            '0x0000000000000001',
            '0x1234567890abcdef1234567890abcdef1234567890abcdef1234567890abcdef',
            '0xD1FE5700000000000000000000000000D1FE5700000000000000000000000000',
        ]
    )->once()->andReturn(true);

    expect($this->eth->submitWork(
        '0x0000000000000001',
        '0x1234567890abcdef1234567890abcdef1234567890abcdef1234567890abcdef',
        '0xD1FE5700000000000000000000000000D1FE5700000000000000000000000000'
    ))
        ->toBe(true);
});

test('get logs', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_getLogs',
        []
    )->once()->andReturn([
        [
            "address" => "0x1a94fce7ef36bc90959e206ba569a12afbc91ca1",
            "blockHash" => "0x7c5a35e9cb3e8ae0e221ab470abae9d446c3a5626ce6689fc777dcffcab52c70",
            "blockNumber" => "0x5c29fb",
            "data" => "0x0000000000000000000000003e3310720058c51f0de456e273c626cdd35065700000000000000000000000000000000000000000000000000000000000003185000000000000000000000000000000000000000000000000000000000000318200000000000000000000000000000000000000000000000000000000005c2a23",
            "logIndex" => "0x1d",
            "removed" => false,
            "topics" => [
                "0x241ea03ca20251805084d27d4440371c34a0b85ff108f6bb5611248f73818b80"
            ],
            "transactionHash" => "0x3dc91b98249fa9f2c5c37486a2427a3a7825be240c1c84961dfb3063d9c04d50",
            "transactionIndex" => "0x1d"
        ],
        [
            "address" => "0x06012c8cf97bead5deae237070f9587f8e7a266d",
            "blockHash" => "0x7c5a35e9cb3e8ae0e221ab470abae9d446c3a5626ce6689fc777dcffcab52c70",
            "blockNumber" => "0x5c29fb",
            "data" => "0x00000000000000000000000077ea137625739598666ded665953d26b3d8e374400000000000000000000000000000000000000000000000000000000000749ff00000000000000000000000000000000000000000000000000000000000a749d00000000000000000000000000000000000000000000000000000000005c2a0f",
            "logIndex" => "0x57",
            "removed" => false,
            "topics" => [
                "0x241ea03ca20251805084d27d4440371c34a0b85ff108f6bb5611248f73818b80"
            ],
            "transactionHash" => "0x788b1442414cb9c9a36dba2abe250763161a6f6395788a2e808f1b34e92beec1",
            "transactionIndex" => "0x54"
        ]
    ]);

    expect($this->eth->getLogs([]))
        ->toBe([
            [
                "address" => "0x1a94fce7ef36bc90959e206ba569a12afbc91ca1",
                "blockHash" => "0x7c5a35e9cb3e8ae0e221ab470abae9d446c3a5626ce6689fc777dcffcab52c70",
                "blockNumber" => "6040059",
                "data" => "0x0000000000000000000000003e3310720058c51f0de456e273c626cdd35065700000000000000000000000000000000000000000000000000000000000003185000000000000000000000000000000000000000000000000000000000000318200000000000000000000000000000000000000000000000000000000005c2a23",
                "logIndex" => "29",
                "removed" => false,
                "topics" => [
                    "0x241ea03ca20251805084d27d4440371c34a0b85ff108f6bb5611248f73818b80"
                ],
                "transactionHash" => "0x3dc91b98249fa9f2c5c37486a2427a3a7825be240c1c84961dfb3063d9c04d50",
                "transactionIndex" => "29"
            ],
            [
                "address" => "0x06012c8cf97bead5deae237070f9587f8e7a266d",
                "blockHash" => "0x7c5a35e9cb3e8ae0e221ab470abae9d446c3a5626ce6689fc777dcffcab52c70",
                "blockNumber" => "6040059",
                "data" => "0x00000000000000000000000077ea137625739598666ded665953d26b3d8e374400000000000000000000000000000000000000000000000000000000000749ff00000000000000000000000000000000000000000000000000000000000a749d00000000000000000000000000000000000000000000000000000000005c2a0f",
                "logIndex" => "87",
                "removed" => false,
                "topics" => [
                    "0x241ea03ca20251805084d27d4440371c34a0b85ff108f6bb5611248f73818b80"
                ],
                "transactionHash" => "0x788b1442414cb9c9a36dba2abe250763161a6f6395788a2e808f1b34e92beec1",
                "transactionIndex" => "84"
            ]
        ]);
});