<?php

namespace MvbCoding\Silex;

use Aws\SimpleDb\SimpleDbClient;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;

/**
 * AWS SDK for PHP service provider for Silex applications
 */
class AwsV3BridgeServiceProvider implements ServiceProviderInterface
{
    const VERSION = '3.0.1';

    public function register(Container $container)
    {
        $container['aws.simpledb'] = function ($container) {
            $config = isset($container['aws.config']) ? $container['aws.config'] : [];

            return new SimpleDbClient($config + ['ua_append' => [
                'Silex/' . Application::VERSION,
                'SXMOD/' . self::VERSION,
            ]]);
        };
    }
}
