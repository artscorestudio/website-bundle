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
	protected $alias;
	
	/**
	 * @var mixed
	 */
	protected $value;
	
	/**
	 * @var \ASF\WebsiteBundle\Model\Config\Group
	 */
	protected $group;
	
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
	public function getAlias()
	{
		return $this->alias;
	}
	
	/**
	 * @param string $alias
	 * @return \ASF\WebsiteBundle\Model\Config\Parameter
	 */
	public function setAlias($alias)
	{
		$this->alias = $alias;
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
	 * @return \ASF\WebsiteBundle\Model\Config\Parameter
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * @return \ASF\WebsiteBundle\Model\Config\Group
	 */
	public function getGroup()
	{
		return $this->group;
	}
	
	/**
	 * @param \ASF\WebsiteBundle\Model\Config\Group $group
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setGroup($group)
	{
		$this->group = $group;
		return $this;
	}
}