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

use ASF\WebsiteBundle\DependencyInjection\ASFWebsiteExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFWebsiteExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var \ASF\WebsiteBundle\DependencyInjection\ASFWebsiteExtension
	 */
	protected $extension;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		parent::setUp();

		$this->extension = new ASFWebsiteExtension();
	}
	
	/**
	 * @covers ASF\WebsiteBundle\DependencyInjection\ASFWebsiteExtension::load
	 */
	public function testLoadExtension()
	{
	    $container = new ContainerBuilder();
		$this->extension->load(array(), $container);
	}
}