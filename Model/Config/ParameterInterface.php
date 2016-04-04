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
	public function getAlias();
	
	/**
	 * @param string $alias
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setAlias($alias);
	
	/**
	 * @return mixed
	 */
	public function getValue();
	
	/**
	 * @param mixed $value
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setValue($value);
}