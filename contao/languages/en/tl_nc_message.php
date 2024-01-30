<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

$GLOBALS['TL_LANG']['tl_nc_message']['expression_legend'] = 'Condition';
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinExpression'] = ['Condition', 'Optional condition for this message to be sent (available variables: form_*, language, request, page).'];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepin_legend'] = 'eyepin API request settings';
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinAction'] = ['Action', 'eyepin API action to be taken.'];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinActionOptions'] = [
    'createAddress' => 'Create address',
    'addToLists' => 'Add to lists',
];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinEmail'] = ['E-mail address', 'E-mail address with which to identify an address.'];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinParameters'] = ['Parameters', 'Parameters for API request. Key = eyepin (e.g. "firstname" | Value = Contao (e.g. "##form_firstname##")'];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinLists'] = ['List', 'The eyepin list within the client.'];
