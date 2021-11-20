<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces;
use Web3\Web3;

beforeEach(function () {
    $this->web3 = new Web3('https://mainnet.infura.io/v3/b583');
});

it('gives access to namespaces', function () {
    expect($this->web3->db())->toBeInstanceOf(Namespaces\Db::class);
    expect($this->web3->eth())->toBeInstanceOf(Namespaces\Eth::class);
    expect($this->web3->net())->toBeInstanceOf(Namespaces\Net::class);
    expect($this->web3->shh())->toBeInstanceOf(Namespaces\Shh::class);
});

it('acts as web3 namespace', function () {
    $transporter = Mockery::mock(Transporter::class);
    $this->web3->setTransporter($transporter);

    $transporter->shouldReceive('request')->once()->andReturn('"EthereumJS TestRPC/v2.13.2/ethereum-js');

    expect($this->web3->clientVersion())->toBe('"EthereumJS TestRPC/v2.13.2/ethereum-js');
});
