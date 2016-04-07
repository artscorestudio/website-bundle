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
 * Website Configuration Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class ConfigModel implements ConfigInterface
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
	
	/**
	 * @var boolean
	 */
	protected $isDefault;
	
	/**
	 * @var \DateTime
	 */
	protected $createdAt;
	
	/**
	 * @var \DateTime
	 */
	protected $updatedAt;
	
	public function __construct()
	{
		$this->parameters = new ArrayCollection();
		$this->isDefault = false;
		$this->createdAt = new \DateTime();
		$this->updatedAt = new \DateTime();
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
	 * @return \ASF\WebsiteBundle\Model\ConfigModel\ConfigInterface
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
	 * @return \ASF\WebsiteBundle\Model\ConfigModel\ConfigInterface
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
	 * @param \ASF\WebsiteBundle\Model\ConfigModel\ParameterInterface $parameter
	 * @return \ASF\WebsiteBundle\Model\ConfigModel\ConfigInterface
	 */
	public function addParameter(ParameterInterface $parameter)
	{
		$this->parameters->add($parameter);
		return $this;
	}
	
	/**
	 * @param \ASF\WebsiteBundle\Model\ConfigModel\ParameterInterface $parameter
	 * @return \ASF\WebsiteBundle\Model\ConfigModel\ConfigInterface
	 */
	public function removeParameter(ParameterInterface $parameter)
	{
		$this->parameters->removeElement($parameter);
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getIsDefault()
	{
		return $this->isDefault;
	}
	
	/**
	 * @param boolean $isDefault
	 * @return \ASF\WebsiteBundle\Model\ConfigModel\ConfigInterface
	 */
	public function setIsDefault($isDefault)
	{
		$this->isDefault = $isDefault;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\WebsiteBundle\Model\ConfigModel\ConfigInterface
	 */
	public function setCreatedAt(\DateTime $date)
	{
		$this->createdAt = $date;
		return $this;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\WebsiteBundle\Model\ConfigModel\ConfigInterface
	 */
	public function setUpdatedAt(\DateTime $date)
	{
		$this->updatedAt = $date;
		return $this;
	}
	
	/**
	 * Update fields before persist
	 */
	public function onPrePersist()
	{
		$this->createdAt = new \DateTime();
		$this->updatedAt = new \DateTime();
	}
	
	/**
	 * Update fields before update
	 */
	public function onPreUpdate()
	{
		$this->updatedAt = new \DateTime();
	}
}