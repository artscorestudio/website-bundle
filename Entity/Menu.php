<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle;

use Doctrine\Common\Collections\ArrayCollection;

class Menu
{
	/**
	 * @var integer
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $alias;
	
	/**
	 * @var string
	 */
	protected $eventName;
	
	/**
	 * @var ArrayCollection
	 */
	protected $children;
	
	public function __construct()
	{
		$this->children = new ArrayCollection();
	}
	
	/**
	 * @return number
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
	 * @return \ASF\WebsiteBundle\Entity\Menu
	 */
	public function setAlias($alias)
	{
		$this->alias = $alias;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getEventName()
	{
		return $this->eventName;
	}
	
	/**
	 * @param string $eventName
	 * @return \ASF\WebsiteBundle\Entity\Menu
	 */
	public function setEventName($eventName)
	{
		$this->eventName = $eventName;
		return $this;
	}
	
	/**
	 * @return ArrayCollection
	 */
	public function getChildren()
	{
		return $this->children;
	}
	
	/**
	 * @param mixed $child
	 * @return \ASF\WebsiteBundle\Entity\Menu
	 */
	public function addChild($child)
	{
		$this->children->add($child);
		return $this;
	}
	
	/**
	 * @param mixed $child
	 * @return \ASF\WebsiteBundle\Entity\Menu
	 */
	public function removeChild($child)
	{
		$this->children->removeElement($child);
		return $this;
	}
}