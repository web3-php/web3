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

it('can be created from eth', function () {
    $wei = Wei::fromEth('1');

    expect((string) $wei)->toBe('1000000000000000000');
});

it('has units', function () {
    $wei = Wei::fromHex('0x0234c8a3397aab58');

    expect($wei)
        ->toWei()->toBe('158972490234375000')
        ->toKwei()->toBe('158972490234375')
        ->toMwei()->toBe('158972490234.375')
        ->toGwei()->toBe('158972490.234375')
        ->toMicroether()->toBe('158972.490234375')
        ->toMilliether()->toBe('158.972490234375')
        ->toEther()->toBe('0.158972490234375')
        ->toEth()->toBe('0.158972490234375');
});

it('handles decimal values on unit conversions', function () {
    $wei = Wei::fromHex('0x64');

    expect($wei)
        ->toWei()->toBe('100')
        ->toKwei()->toBe('0.1')
        ->toMwei()->toBe('0.0001');
});
