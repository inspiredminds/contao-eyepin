<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepinGateway;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoEyepinGatewayBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
