<?php

use Web3\Formatters\HexToUnsignedIntegerAsString;

it('formats int hex to unsigned integer as string', function () {
    $hex = '0x0234c8a3397aab58';

    $result = HexToUnsignedIntegerAsString::format($hex);

    expect($result)->toBe('158972490234375000');
});

it('formats decimal hex to unsigned integer as string', function () {
    // @todo
});
