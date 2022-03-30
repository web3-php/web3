<?php

use Web3\Exceptions\ValidatorException;
use Web3\Validators\FilterObject;

it('validates filter objects', function () {
    $result = FilterObject::validate([
        'address' => '0x1a94fce7ef36bc90959e206ba569a12afbc91ca1',
        'fromBlock' => '12',
        'toBlock' => '24',
        'topics' => ['ddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef'],
        'blockhash' => '0x7c5a35e9cb3e8ae0e221ab470abae9d446c3a5626ce6689fc777dcffcab52c70',
    ]);
    expect($result)->toBe(true);
});

it('throws errors on invalid filter objects', function () {
    $this->expectException(ValidatorException::class);
    FilterObject::validate([
        'address' => '0x1a94fce7ef36bc90959e206ba569a12afbc91ca1',
        'fromBlock' => '12',
        'toBlock' => '24',
        'topics' => 'ddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef',
        'blockhash' => '0x7c5a35e9cb3e8ae0e221ab470abae9d446c3a5626ce6689fc777dcffcab52c70',
    ]);
});
