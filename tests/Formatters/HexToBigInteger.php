<?php

use Web3\Formatters\HexToBigInteger;

it('formats hex to big integer', function () {
    $hex = '0x0234c8a3397aab58';

    $result = HexToBigInteger::format($hex);

    expect($result)->toBe('158972490234375000');
});
