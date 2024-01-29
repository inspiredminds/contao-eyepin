<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Eyepin extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepin\Eyepin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EyepinApi
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function request(\SimpleXMLElement|string $endpoint): \SimpleXMLElement
    {
        if (\is_string($endpoint)) {
            $endpoint = new \SimpleXMLElement('<'.$endpoint.' />');
        }

        $response = $this->httpClient->request(
            Request::METHOD_POST,
            '',
            [
                'body' => $endpoint->asXML(),
            ],
        );

        $responseXml = new \SimpleXMLElement($response->getContent());

        if ('2000' !== (string) $responseXml->code) {
            throw new \RuntimeException((string) $responseXml->description);
        }

        return $responseXml->data;
    }
}
