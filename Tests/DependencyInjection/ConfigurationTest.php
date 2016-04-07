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
	 * @var array
	 */
	private $defaultConfig;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		$processor = new Processor();
		$this->defaultConfig = $processor->processConfiguration(new Configuration(), array());
	}
	
    /**
     * @covers ASF\WebsiteBundle\DependencyInjection\Configuration
     */
	public function testDefaultConfiguration()
	{
		$this->assertCount(3, $this->defaultConfig);
	}
	
	/**
	 * @covers ASF\WebsiteBundle\DependencyInjection\Configuration::addGroupParameterNode
	 */
	public function testGroupLoadFormName()
	{
		$this->assertEquals('ASF\WebsiteBundle\Form\Type\GroupType', $this->defaultConfig['group']['form']['type']);
		$this->assertEquals('website_group_parameter_type', $this->defaultConfig['group']['form']['name']);
	}
	
	/**
	 * @covers ASF\WebsiteBundle\DependencyInjection\Configuration::addParameterParameterNode
	 */
	public function testGroupParameterLoadFormName()
	{
		$this->assertEquals('ASF\WebsiteBundle\Form\Type\ParameterType', $this->defaultConfig['parameter']['form']['type']);
		$this->assertEquals('website_parameter_type', $this->defaultConfig['parameter']['form']['name']);
	}
}