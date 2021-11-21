<?php

use Web3\Formatters\HexToIntOrFloat;

it('formats hex to int or floats', function () {
    $hex = '0x0234c8a3397aab58';

    $result = HexToIntOrFloat::format($hex);

    expect($result)->toBe('158972490234375000');
});
