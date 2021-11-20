<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Web3;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->web3 = new Web3($this->transporter);
});

it('can make requests', function () {
    $this->transporter->shouldReceive('request')->with(
        'web3_sha3',
        [
            '0x68656c6c6f20776f726c64',
        ]
    )->once()->andReturn('0x47173285a8d7341e5e972fc677286384f802f8ef42a5ec5f03bbfa254cb01fad');

    expect($this->web3->sha3(['0x68656c6c6f20776f726c64']))->toBe(
        '0x47173285a8d7341e5e972fc677286384f802f8ef42a5ec5f03bbfa254cb01fad'
    );
});
