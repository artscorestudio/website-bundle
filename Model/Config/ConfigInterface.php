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
 * Website Configuration Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface ConfigInterface
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
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function setName($name);
	
	/**
	 * @return string
	 */
	public function getAlias();
	
	/**
	 * @param string $alias
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function setAlias($alias);
	
	/**
	 * @return ArrayCollection
	 */
	public function getParameters();
	
	/**
	 * @param \ASF\WebsiteBundle\Model\Config\ParameterInterface $parameter
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function addParameter(ParameterInterface $parameter);
	
	/**
	 * @param \ASF\WebsiteBundle\Model\Config\ParameterInterface $parameter
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function removeParameter(ParameterInterface $parameter);

	/**
	 * @return boolean
	 */
	public function getIsDefault();
	
	/**
	 * @param boolean $isDefault
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function setIsDefault($isDefault);

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt();
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function setCreatedAt(\DateTime $date);
	
	/**
	 * @return \DateTime
	 */
	public function getUpdatedAt();
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function setUpdatedAt(\DateTime $date);
}