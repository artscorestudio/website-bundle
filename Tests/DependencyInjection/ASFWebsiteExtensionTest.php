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
use Symfony\Bundle\AsseticBundle\DependencyInjection\AsseticExtension;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use FOS\UserBundle\DependencyInjection\FOSUserExtension;

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
	private $extension;
	
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
	    $this->extension->load(array(), $this->getContainer());
	}
	
	/**
	 * @covers ASF\WebsiteBundle\DependencyInjection\ASFWebsiteExtension::prepend
	 */
	public function testPrependExtension()
	{
		$this->extension->prepend($this->getContainer());
	}
	
	/**
	 * @covers ASF\WebsiteBundle\DependencyInjection\ASFWebsiteExtension::configureTwigBundle
	 */
	public function testConfigureTwigBundle()
	{
		$container = new ContainerBuilder();
		$this->extension->configureTwigBundle($container, array(
			'asf_website' => array('form_theme' => 'ASFWebsiteBundle:Form:fields.html.twig') 
		));
	}

	/**
	 * Return a mock object of ContainerBuilder
	 *
	 * @return \Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected function getContainer($bundles = null, $extensions = null)
	{
		$bag = $this->getMock('Symfony\Component\DependencyInjection\ParameterBag\ParameterBag');
		$bag->method('add');
		 
		if ( is_null($bundles) ) {
			$bundles = $bundles = array(
				'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
				'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle',
				'FOSUserBundle' => 'FOS\UserBundle\FOSUserBundle',
			);
		}
		 
		if ( is_null($extensions) ) {
			$extensions = array(
				'assetic' => new AsseticExtension(),
				'twig' => new TwigExtension(),
				'fos_user' => new FOSUserExtension(),
			);
		}
		
		$container = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$container->method('getParameter')->with('kernel.bundles')->willReturn($bundles);
		$container->method('getExtensions')->willReturn($extensions);

		$container->method('getExtensionConfig')->willReturn(array());
		$container->method('prependExtensionConfig');
		$container->method('setAlias');
		$container->method('getExtension');
		 
		$container->method('addResource');
		$container->method('setParameter');
		$container->method('getParameterBag')->willReturn($bag);
		$container->method('setDefinition');
		$container->method('setParameter');
		
		return $container;
	}
	
	/**
	 * Return bundle's default configuration
	 *
	 * @return array
	 */
	protected function getDefaultConfig()
	{
		return array(
			'form_theme' => 'ASFWebsiteBundle:Form:fields.html.twig',
			'config' => array(
				'form' => array(
					'type' => "ASF\WebsiteBundle\Form\Type\ConfigType",
					'name' => 'website_config_type'	
				)
			),
			'parameter' => array(
				'form' => array(
					'type' => "ASF\WebsiteBundle\Form\Type\ParameterType",
					'name' => 'website_parameter_type'
				)
			)
		);
	}
}