<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Eyepin extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepin\Eyepin;

use InspiredMinds\ContaoEyepin\Model\EyepinClientModel;
use Symfony\Component\HttpClient\HttpClient;

class EyepinApiFactory
{
    public function __construct(private readonly string $eyepinApiUrl)
    {
    }

    public function createForCredentials(string $username, string $password): EyepinApi
    {
        $client = HttpClient::createForBaseUri($this->eyepinApiUrl, [
            'auth_basic' => [$username, $password],
            'headers' => [
                'Content-Type' => 'text/xml',
            ],
        ]);

        return new EyepinApi($client);
    }

    public function createForClientModel(EyepinClientModel $eyepinClient): EyepinApi
    {
        return $this->createForCredentials($eyepinClient->username, $eyepinClient->password);
    }
}
