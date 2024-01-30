<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepinGateway\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use InspiredMinds\EyepinApi\EyepinApiFactory;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Callbacks for tl_nc_gateway.
 */
class GatewayListener
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly EyepinApiFactory $eyepinApiFactory,
    ) {
    }

    #[AsCallback('tl_nc_gateway', 'fields.eyepinPassword.save')]
    public function onPasswordSave(mixed $value): mixed
    {
        $request = $this->requestStack->getCurrentRequest();

        // Check credentials
        $this->eyepinApiFactory
            ->createForCredentials(
                $request->request->get('eyepinUsername'),
                $request->request->get('eyepinPassword'),
            )
            ->getAccountInfo()
        ;

        return $value;
    }
}
