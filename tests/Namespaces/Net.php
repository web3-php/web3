<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Net;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->net = new Net($this->transporter);
});

it('can make requests', function () {
    $this->transporter->shouldReceive('request')->with(
        'net_listening', [],
    )->once()->andReturn(true);

    expect($this->net->listening())->toBeTrue();
});
