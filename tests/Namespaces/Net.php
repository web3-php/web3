<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Net;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->net = new Net($this->transporter);
});

test('listening', function () {
    $this->transporter->shouldReceive('request')->with(
        'net_listening'
    )->once()->andReturn(true);

    expect($this->net->listening())
        ->toBeTrue();
});

test('peer count', function () {
    $this->transporter->shouldReceive('request')->with(
        'net_peerCount'
    )->once()->andReturn('0xA');

    expect($this->net->peerCount())
        ->toBe(10);
});

test('version', function () {
    $this->transporter->shouldReceive('request')->with(
        'net_version'
    )->once()->andReturn('1');

    expect($this->net->version())
        ->toBe('1');
});
