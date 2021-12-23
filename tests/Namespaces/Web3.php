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
        'web3_sha3', ['0x68656c6c6f20776f726c64']
    )->once()->andReturn('0x5b2c76da96136d193336fad3fbc049867b8ca157da22f69ae0e4923648250acc');

    expect($this->web3->sha3('hello world'))
    ->toBe('0x5b2c76da96136d193336fad3fbc049867b8ca157da22f69ae0e4923648250acc');

    $this->transporter->shouldReceive('request')->with(
        'web3_sha3', ['0x30782068656c6c6f20776f726c64']
    )->once()->andReturn('0x9b886e3c06058fc79e473463c5a3a43d9bead0ff9c8ecf5858840094a7ace88e');

    expect($this->web3->sha3('0x hello world'))
            ->toBe('0x9b886e3c06058fc79e473463c5a3a43d9bead0ff9c8ecf5858840094a7ace88e');
});
