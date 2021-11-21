<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Eth;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->eth = new Eth($this->transporter);
});

it('can make requests', function () {
    $this->transporter->shouldReceive('request')->with(
        'eth_getBalance',
        [
            '0x407d73d8a49eeb85d32cf465507dd71d507100c1',
            'latest',
        ]
    )->once()->andReturn('0x0234c8a3397aab58');

    expect($this->eth->getBalance([
        '0x407d73d8a49eeb85d32cf465507dd71d507100c1',
        'latest',
    ]))->toBe('158972490234375000');
});
