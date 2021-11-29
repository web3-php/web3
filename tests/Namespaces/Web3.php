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
