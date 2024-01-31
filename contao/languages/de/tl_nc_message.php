<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

$GLOBALS['TL_LANG']['tl_nc_message']['expression_legend'] = 'Bedingung';
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinExpression'] = ['Bedingung', 'Optionale Bedingung um diese Nachricht zu senden. Verfügbare Variablen: form_*, language, request, page. Verfügbare Funktionen: in_array und explode.'];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepin_legend'] = 'eyepin API Request Einstellungen';
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinAction'] = ['Aktion', 'Auszuführende eyepin API Aktion.'];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinActionOptions'] = [
    'createAddress' => 'Adresse anlegen',
    'addToLists' => 'Zu Listen hinzufügen',
];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinEmail'] = ['E-Mail Adresse', 'E-Mail Adresse mit dieser ein Adress-Eintrag identifiziert wird.'];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinParameters'] = ['Parameter', 'Parameter für die API Anfrage. Schlüssel = eyepin (z.B. "firstname" | Wert = Contao (z.B. "##form_firstname##")'];
$GLOBALS['TL_LANG']['tl_nc_message']['eyepinLists'] = ['Liste', 'Die eyepin List innerhalb des Mandanten.'];
