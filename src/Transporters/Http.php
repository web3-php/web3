<?php

declare(strict_types=1);

namespace Web3\Transporters;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Web3\Contracts\Transporter;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;

final class Http implements Transporter
{
    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(
        private ClientInterface $client,
        private string $url,
    ) {
        // ..
    }

    /**
     * {@inheritDoc}
     */
    public function request(string $method, array $params = []): array|string|bool
    {
        $body = (string) json_encode([
            'jsonrpc' => '2.0',
            'id'      => '1',
            'method'  => $method,
            'params'  => $params,
        ]);

        $headers = [
            'Content-Type'   => 'application/json',
            'Content-Length' => (string) strlen($body),
        ];

        $request = new Request('POST', $this->url, $headers, $body);

        try {
            $contents = $this->client->sendRequest($request)->getBody()->getContents();
        } catch (ClientExceptionInterface $clientException) {
            /** @var int $code */
            $code    = $clientException->getCode();
            $message = $clientException->getMessage();

            throw new TransporterException($message, $code, $clientException);
        }

        /** @var array{'error'?: array{'code': int, 'message': string}, 'result': array<array-key, mixed>|string|bool}} $response */
        $response = json_decode($contents, true);

        if (array_key_exists('error', $response)) {
            throw new ErrorException($response['error']);
        }

        return $response['result'];
    }
}
