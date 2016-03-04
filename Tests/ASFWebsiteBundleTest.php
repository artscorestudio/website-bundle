<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Tests;

use ASF\WebsiteBundle\ASFWebsiteBundle;

/**
 * Core Bundle Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFWebsiteBundleTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @cover \ASF\WebsiteBundle\ASFWebsiteBundle
	 */
	public function testBuild()
	{
		$container = $this->getContainer();
		
		$bundle = new ASFWebsiteBundle();
		$bundle->build($container);
	}
	
	/**
	 * Return a mock object of ContainerBuilder
	 *
	 * @return \Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected function getContainer()
	{
	    $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
		return $container;
	}
}