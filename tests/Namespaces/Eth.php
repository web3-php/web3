<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Eth;

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

test('is mining', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_mining'
    )->once()->andReturn(false);

    expect($this->eth->isMining())
        ->toBe(false);
});
