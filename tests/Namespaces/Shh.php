<?php

use Web3\Contracts\Transporter;
use Web3\Namespaces\Shh;

beforeEach(function () {
    $this->transporter = Mockery::mock(Transporter::class);

    $this->shh = new Shh($this->transporter);
});

it('can make requests', function () {
    $this->transporter->shouldReceive('request')->with(
        'shh_hasIdentity',
        [
            '0x04f96a5e25610293e42a73908e93ccc8c4d4dc0edcfa9fa872f50cb214e08ebf61a03e245533f97284d442460f2998cd41858798ddfd4d661997d3940272b717b1',
        ]
    )->once()->andReturn(true);

    expect($this->shh->hasIdentity([
        '0x04f96a5e25610293e42a73908e93ccc8c4d4dc0edcfa9fa872f50cb214e08ebf61a03e245533f97284d442460f2998cd41858798ddfd4d661997d3940272b717b1',
    ]))->toBeTrue();
});
