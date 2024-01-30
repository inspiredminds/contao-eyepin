<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

use InspiredMinds\ContaoEyepinGateway\Gateway\EyepinGateway;

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['eyepinUsername'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50', 'decodeEntities' => true, 'preserveTags' => true],
    'exclude' => true,
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['eyepinPassword'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50', 'decodeEntities' => true, 'preserveTags' => true],
    'exclude' => true,
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['palettes'][EyepinGateway::TYPE] = '{title_legend},title,type;{gateway_legend},eyepinUsername,eyepinPassword';
