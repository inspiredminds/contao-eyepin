<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Eyepin extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepinGateway\Model;

use Contao\Model;

/**
 * @property int    $id
 * @property int    $tstamp
 * @property string $name
 * @property string $username
 * @property string $password
 */
class EyepinClientModel extends Model
{
    protected static $strTable = 'tl_eyepin_client';
}
