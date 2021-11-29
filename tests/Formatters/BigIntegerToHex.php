<?php

use Web3\Formatters\BigIntegerToHex;

it('formats big integer to hex', function () {
    $string = '16';

    $result = BigIntegerToHex::format($string);

    expect($result)->toBe('0x10');
});
