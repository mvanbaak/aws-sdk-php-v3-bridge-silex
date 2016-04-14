# AWS SDK for PHP - Version 3 Upgrade Bridge Provider for Silex

[![Latest Stable Version](https://poser.pugx.org/mvbcoding/aws-sdk-php-v3-bridge-silex/v/stable)](https://packagist.org/packages/mvbcoding/aws-sdk-php-v3-bridge-silex)
[![Total Downloads](https://poser.pugx.org/mvbcoding/aws-sdk-php-v3-bridge-silex/downloads)](https://packagist.org/packages/mvbcoding/aws-sdk-php-v3-bridge-silex)
[![License](https://poser.pugx.org/mvbcoding/aws-sdk-php-v3-bridge-silex/license)](https://packagist.org/packages/mvbcoding/aws-sdk-php-v3-bridge-silex)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/63d301ce-db14-4bf1-a7a9-329b135617bf/mini.png)](https://insight.sensiolabs.com/projects/63d301ce-db14-4bf1-a7a9-329b135617bf)
[![Codeship build status](https://codeship.com/projects/988a8460-e445-0133-d9c3-2ef0590de381/status?branch=master)](https://codeship.com/projects/146266)

A simple Silex service provider for including the [AWS SDK for PHP - Version 3 Upgrade Bridge](https://github.com/aws/aws-sdk-php-v3-bridge).

## Installation

The AWS Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`mvbcoding/aws-sdk-php-v3-bridge-silex` package in your project's `composer.json`.

```json
{
    "require": {
        "mvbcoding/aws-sdk-php-v3-bridge-silex": "^1.0"
    }
}
```

## Usage

Register the AWS Service Provider in your Silex application and provide your AWS SDK for PHP configuration to the app
in the `aws.config` key. `$app['aws.config']` should contain an array of configuration options or the path to a
configuration file. This value is passed directly into `new Aws\SimpleDb\SimpleDbClient` and `new Aws\ImportExport\ImportExportClient`.

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use MvbCoding\Silex\AwsV3BridgeServiceProvider;
use Silex\Application;

$app = new Application();

$app->register(new AwsV3BridgeServiceProvider(), array(
    'aws.config' => array(
        'version' => 'latest',
        'region' => 'eu-west-1',
    )
));

$app->match('/', function () use ($app) {
    // Create a list of your SimpleDb Domains
    $domains = $app['aws.simpledb']->listDomains();
    $output = "<ul>\n";
    foreach ($domains['DomainNames'] as $domain) {
        $output .= "<li>{$domain}</li>\n";
    }
    $output .= "</ul>\n";

    return $output;
});

$app->run();
```

## Links

* [AWS SDK for PHP - Version 3 Upgrade Bridge](https://github.com/aws/aws-sdk-php-v3-bridge)
* [License](https://opensource.org/licenses/BSD-2-Clause)
* [Silex website](http://silex.sensiolabs.org)
* [MvBCoding website](http://www.mvbcoding.nl)

