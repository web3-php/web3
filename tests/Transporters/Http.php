<?php

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;
use Web3\Transporters\Http;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $this->http = new Http($this->client, 'https://mainnet.infura.io/v3/b583');
});

it('can retrieve results', function () {
    $response = new Response(200, [], json_encode([
        'result' => '0x0234c8a3397aab58',
    ]));

    $this->client->shouldReceive('sendRequest')->withArgs(function (Request $request) {
        expect($request->getMethod())->toBe('POST');
        expect($request->getUri())
            ->getHost()->toBe('mainnet.infura.io')
            ->getScheme()->toBe('https')
            ->getPath()->toBe('/v3/b583');

        return true;
    })->once()->andReturn($response);

    $response = $this->http->request('eth_getBalance', [
        '0x407d73d8a49eeb85d32cf465507dd71d507100c1',
        'latest',
    ]);

    expect($response)->toBe('0x0234c8a3397aab58');
});

it('can handle errors', function () {
    $response = new Response(200, [], json_encode([
        'error' => [
            'code'    => -32602,
            'message' => 'Invalid params',
        ],
    ]));

    $this->client->shouldReceive('sendRequest')->once()->andReturn($response);

    expect(fn () => $this->http->request('eth_getBalance', [
        '0x407d73d8a49eeb85d32cf465507dd71d507100c1',
        'latest',
    ]))->toThrow(fn (ErrorException $e) => expect($e)
        ->getCode()->toBe(-32602)
        ->message()->toBe('Invalid params')
    );
});

it('can handle transporter exceptions', function () {
    $exception = new ConnectException('Unable to resolve something.', Mockery::mock(Request::class));
    $this->client->shouldReceive('sendRequest')->once()->andThrow($exception);

    $this->http->request('eth_getBalance', [
        '0x407d73d8a49eeb85d32cf465507dd71d507100c1',
        'latest',
    ]);
})->throws(TransporterException::class, 'Unable to resolve something.');
