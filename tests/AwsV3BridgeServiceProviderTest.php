<?php
namespace MvbCoding\Silex;

use Silex\Application;

class AwsV3BridgeServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterAwsSimpleDbClient()
    {
        //setup silex and aws service provider
        $app = new Application();
        $provider = new AwsV3BridgeServiceProvider();
        $app->register($provider, [
            'aws.config' => [
                'version' => '2009-04-15',
                'region' => 'us-east-1',
                'credentials' => [
                    'key' => 'fake-aws-key',
                    'secret' => 'fake-aws-secret',
                ],
            ],
        ]);
        $provider->boot($app);

        $this->assertEquals('2009-04-15', $app['aws.config']['version']);
        $this->assertEquals('us-east-1', $app['aws.config']['region']);
        $this->assertEquals('2009-04-15', $app['aws.simpledb']->getApi()->getApiVersion());
        $this->assertEquals('us-east-1', $app['aws.simpledb']->getRegion());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNoConfigProvided()
    {
        // Setup the Silex app and AWS service provider
        $app = new Application();
        $provider = new AwsV3BridgeServiceProvider();
        $app->register($provider, array(
            'aws.config' => array(
                'credentials' => [
                    'key' => 'fake-aws-key',
                    'secret' => 'fake-aws-secret',
                ],
            )
        ));
        $provider->boot($app);

        // Get the region of simpledb service, which should
        // throw an InvalidArgumentException because of missing config
        $region = $app['aws.simpledb']->getRegion();
    }
}
