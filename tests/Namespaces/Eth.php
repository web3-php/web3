<?php

use Web3\Contracts\Transporter;
use Web3\Formatters\HexToWei;
use Web3\Namespaces\Eth;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->eth = new Eth($this->transporter);
});

test('client version', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_accounts'
    )->once()->andReturn([
        '0x407d73d8a49eeb85d32cf465507dd71d507100c1',
    ]);

    expect($this->eth->accounts())
        ->toBe([('0x407d73d8a49eeb85d32cf465507dd71d507100c1')]);
});

it('retrieves the current gas price in Wei', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_gasPrice'
    )->once()->andReturn('0x400');

    expect($this->eth->gasPrice())
        ->toEqual(HexToWei::format('0x400'));
});
