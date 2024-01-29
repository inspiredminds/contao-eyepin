<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Eyepin extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepin\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use InspiredMinds\ContaoEyepin\Eyepin\EyepinApiFactory;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Callbacks for tl_eyepin_client.
 */
class EyepinClientListener
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly EyepinApiFactory $eyepinApiFactory,
    ) {
    }

    #[AsCallback('tl_eyepin_client', 'fields.password.save')]
    public function onPasswordSave(mixed $value): mixed
    {
        $request = $this->requestStack->getCurrentRequest();

        // Check credentials
        $this->eyepinApiFactory
            ->createForCredentials(
                $request->request->get('username'),
                $request->request->get('password'),
            )
            ->request('getaccountinfo')
        ;

        return $value;
    }
}
