<?php

namespace MvbCoding\Silex;

use Aws\ImportExport\ImportExportClient;
use Aws\SimpleDb\SimpleDbClient;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * AWS SDK for PHP service provider for Silex applications
 */
class AwsV3BridgeServiceProvider implements ServiceProviderInterface
{
    const VERSION = '1.0.2';

    public function register(Application $app)
    {
        $app['aws.simpledb'] = $app->share(function (Application $app) {
            $config = isset($app['aws.config']) ? $app['aws.config'] : [];

            return new SimpleDbClient($config + ['ua_append' => [
                'Silex/' . Application::VERSION,
                'SXMOD/' . self::VERSION,
            ]]);
        });

        $app['aws.importexport'] = $app->share(function (Application $app) {
            $config = isset($app['aws.config']) ? $app['aws.config'] : [];

            return new ImportExportClient($config + ['ua_append' => [
                'Silex/' . Application::VERSION,
                'SXMOD/' . self::VERSION,
            ]]);
        });

    }

    public function boot(Application $app)
    {
    }
}
