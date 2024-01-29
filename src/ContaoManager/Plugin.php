<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Eyepin extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepin\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use InspiredMinds\ContaoEyepin\ContaoEyepinBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoEyepinBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
