<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

use InspiredMinds\ContaoEyepinGateway\Gateway\EyepinGateway;

$GLOBALS['TL_LANG']['tl_nc_gateway']['type'][EyepinGateway::TYPE] = 'eyepin API';
$GLOBALS['TL_LANG']['tl_nc_gateway']['eyepinUsername'] = ['Username', 'Username of the eyepin API connection credentials.'];
$GLOBALS['TL_LANG']['tl_nc_gateway']['eyepinPassword'] = ['Password', 'Password of the eyepin API connection credentials.'];
