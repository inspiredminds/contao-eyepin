<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Eyepin extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepin;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoEyepinBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
