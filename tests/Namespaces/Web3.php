<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Web3;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->web3 = new Web3($this->transporter);
});

test('client version', function () {
    $this->transporter->shouldReceive('request')->with(
        'web3_clientVersion'
    )->once()->andReturn('Geth/v1.10.12-omnibus-16948b3c/linux-amd64/go1.17.3');

    expect($this->web3->clientVersion())
        ->toBe('Geth/v1.10.12-omnibus-16948b3c/linux-amd64/go1.17.3');
});

test('sha3', function () {
    $this->transporter->shouldReceive('request')->with(
        'web3_sha3',
        ['0x48656c6c6f20576f726c64'],
    )->once()
        ->andReturn('0x592fa743889fc7f92ac2a37bb1f5ba1daf2a5c84741ca0e0061d243a2e6707ba');

    expect($this->web3->sha3('Hello World'))
        ->toBe('0x592fa743889fc7f92ac2a37bb1f5ba1daf2a5c84741ca0e0061d243a2e6707ba');
});
