<?php

use Web3\ValueObjects\Wei;

it('has a value', function () {
    $wei = Wei::fromHex('0x0234c8a3397aab58');

    expect($wei->value())->toBe('158972490234375000');
});

it('has a string representation', function () {
    $wei = Wei::fromHex('0x0234c8a3397aab58');

    expect((string) $wei)->toBe('158972490234375000');
});

it('has units', function () {
    $wei = Wei::fromHex('0xDE0B6B3A7640000');

    expect($wei)
        ->toWei()->toBe('1000000000000000000')
        ->toKwei()->toBe('1000000000000000')
        ->toMwei()->toBe('1000000000000')
        ->toGwei()->toBe('1000000000')
        ->toMicroether()->toBe('1000000')
        ->toMilliether()->toBe('1000')
        ->toEther()->toBe('1')
        ->toEth()->toBe('1');
});

it('handles negative values on unit conversions', function () {
    $wei = Wei::fromHex('0x64');

    expect($wei)
        ->toWei()->toBe('100')
        ->toKwei()->toBe('0.1')
        ->toMwei()->toBe('0.0001');
});
