<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Model\Config;

/**
 * Config parameter Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface ParameterInterface
{
	/**
	 * @return integer
	 */
	public function getId();
	
	/**
	 * @return string
	 */
	public function getName();
	
	/**
	 * @param string $name
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setName($name);
	
	/**
	 * @return mixed
	 */
	public function getValue();
	
	/**
	 * @param mixed $value
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setValue($value);
	
	/**
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function getConfig();
	
	/**
	 * @param ConfigInterface $config
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setConfig(ConfigInterface $config);
}