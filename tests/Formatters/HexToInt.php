<?php

use Web3\Formatters\HexToInt;

it('formats hex to int', function () {
    $hex = '0x0234c8a3397aab58';

    $result = HexToInt::format($hex);

    expect($result)->toBe(158972490234375000);
});
