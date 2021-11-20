<?php

use Web3\Contracts\Transporter;
use Web3\Exceptions\InvalidUrlException;
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

    $reflection = new ReflectionClass($this->web3);
    $property = $reflection->getProperty('transporter');
    $property->setAccessible(true);
    $property->setValue($this->web3, $transporter);

    $transporter->shouldReceive('request')->once()->andReturn('"EthereumJS TestRPC/v2.13.2/ethereum-js');

    expect($this->web3->clientVersion())->toBe('"EthereumJS TestRPC/v2.13.2/ethereum-js');
});

it('attemps the create the transporter based on the url', function () {
    $web3 = new Web3('foo://mainnet.infura.io/v3/b583');

    $web3->clientVersion();
})->throws(InvalidUrlException::class, 'The given url must start by "http".');
