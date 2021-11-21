<?php

use Web3\Formatters\HexToWei;

it('formats hex to int or floats', function () {
    $hex = '0x0234c8a3397aab58';

    $result = HexToWei::format($hex);

    expect($result)->toBeInstanceOf(\Web3\ValueObjects\Wei::class)
        ->value()->toBe('158972490234375000');
});
