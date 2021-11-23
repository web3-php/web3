<?php

use Web3\Formatters\StringToHex;

it('formats string to hex', function () {
    $string = 'Hello World';

    $result = StringToHex::format($string);

    expect($result)->toBe('0x48656c6c6f20576f726c64');
});
