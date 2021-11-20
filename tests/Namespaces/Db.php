<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Db;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->db = new Db($this->transporter);
});

it('can make requests', function () {
    $this->transporter->shouldReceive('request')->with(
        'db_putString',
        [
            'testDB',
            'myKey',
            'myString',
        ]
    )->once()->andReturn(true);

    expect($this->db->putString([
        'testDB',
        'myKey',
        'myString',
    ]))->toBeTrue();
});
