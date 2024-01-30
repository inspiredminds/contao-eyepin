<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

use Doctrine\DBAL\Platforms\MySQLPlatform;
use InspiredMinds\ContaoEyepinGateway\Gateway\EyepinGateway;

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['eyepinExpression'] = [
    'inputType' => 'text',
    'eval' => ['maxlength' => MySQLPlatform::LENGTH_LIMIT_TEXT, 'tl_class' => 'clr', 'decodeEntities' => true],
    'exclude' => true,
    'sql' => ['type' => 'text', 'length' => MySQLPlatform::LENGTH_LIMIT_TEXT, 'notnull' => false],
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['eyepinAction'] = [
    'exclude' => true,
    'inputType' => 'select',
    'eval' => ['chosen' => true, 'mandatory' => true, 'tl_class' => 'clr w50', 'includeBlankOption' => true, 'submitOnChange' => true],
    'options' => [
        'createAddress',
        'addToLists',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_nc_message']['eyepinActionOptions'],
    'sql' => ['type' => 'string', 'length' => 64, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['eyepinEmail'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'],
    'exclude' => true,
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['eyepinParameters'] = [
    'exclude' => true,
    'inputType' => 'keyValueWizard',
    'eval' => ['tl_class' => 'clr'],
    'sql' => ['type' => 'blob', 'length' => MySQLPlatform::LENGTH_LIMIT_BLOB, 'notnull' => false],
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['eyepinLists'] = [
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr', 'multiple' => true],
    'exclude' => true,
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_nc_message']['palettes'][EyepinGateway::TYPE] = '{title_legend},title,gateway;{expression_legend},eyepinExpression;{eyepin_legend},eyepinAction;{publish_legend},published';
$GLOBALS['TL_DCA']['tl_nc_message']['palettes']['__selector__'][] = 'eyepinAction';
$GLOBALS['TL_DCA']['tl_nc_message']['subpalettes']['eyepinAction_createAddress'] = 'eyepinEmail,eyepinParameters,eyepinLists';
$GLOBALS['TL_DCA']['tl_nc_message']['subpalettes']['eyepinAction_addToLists'] = 'eyepinEmail,eyepinLists';
