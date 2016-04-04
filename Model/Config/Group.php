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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Group Config Parameter
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class Group
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
	 * @var string
	 */
	protected $alias;
	
	/**
	 * @var ArrayCollection
	 */
	protected $parameters;
	
	public function __construct()
	{
		$this->parameters = new ArrayCollection();
	}
	
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
	 * @return \ASF\WebsiteBundle\Model\Config\Group
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
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
	 * @return \ASF\WebsiteBundle\Model\Config\Group
	 */
	public function setAlias($alias)
	{
		$this->alias = $alias;
		return $this;
	}
	
	/**
	 * @return ArrayCollection
	 */
	public function getParameters()
	{
		return $this->parameters;
	}
	
	/**
	 * @param \ASF\WebsiteBundle\Model\Config\ParameterInterface $parameter
	 * @return \ASF\WebsiteBundle\Model\Config\Group
	 */
	public function addParameter(Parameter $parameter)
	{
		$this->parameters->add($parameter);
		return $this;
	}
	
	/**
	 * @param \ASF\WebsiteBundle\Model\Config\ParameterInterface $parameter
	 * @return \ASF\WebsiteBundle\Model\Config\Group
	 */
	public function removeParameter(Parameter $parameter)
	{
		$this->parameters->removeElement($parameter);
		return $this;
	}
}