<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepinGateway\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use InspiredMinds\EyepinApi\EyepinApiFactory;
use NotificationCenter\Model\Gateway;

/**
 * Callbacks for tl_nc_message.
 */
class MessageListener
{
    public function __construct(
        private readonly EyepinApiFactory $eyepinApiFactory,
    ) {
    }

    #[AsCallback('tl_nc_message', 'fields.eyepinLists.options')]
    public function onListIdOptions(DataContainer $dc): array
    {
        if (!$gateway = Gateway::findByPk($dc->activeRecord->gateway)) {
            return [];
        }

        $options = [];

        $addressLists = $this->eyepinApiFactory
            ->createForCredentials(
                $gateway->eyepinUsername,
                $gateway->eyepinPassword,
            )
            ->getAddressLists()
        ;

        foreach ($addressLists->addressLists as $addressList) {
            $options[$addressList->id] = $addressList->name;
        }

        return $options;
    }
}
