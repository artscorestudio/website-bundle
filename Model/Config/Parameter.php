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
 * Config parameter
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class Parameter implements ParameterInterface
{
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var mixed
	 */
	protected $value;
	
	/**
	 * @var \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	protected $config;
	
	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * @param mixed $value
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function getConfig()
	{
		return $this->config;
	}
	
	/**
	 * @param \ASF\WebsiteBundle\Model\Config\ConfigInterface $config
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setConfig(ConfigInterface $config)
	{
		$this->config = $config;
		return $this;
	}
}