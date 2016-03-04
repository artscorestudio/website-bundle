<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Tests\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use ASF\WebsiteBundle\DependencyInjection\Configuration;

/**
 * This test case check if the default bundle's configuration from bundle's Configuration class is OK
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr
 *
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ASF\WebsiteBundle\DependencyInjection\Configuration
     */
	public function testDefaultConfiguration()
	{
		$processor = new Processor();
		$config = $processor->processConfiguration(new Configuration(), array());
		$this->assertCount(0, $config);
	}
}