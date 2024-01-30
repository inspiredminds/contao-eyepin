<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

use InspiredMinds\ContaoEyepinGateway\Gateway\EyepinGateway;

$GLOBALS['NOTIFICATION_CENTER']['GATEWAY'][EyepinGateway::TYPE] = EyepinGateway::class;
