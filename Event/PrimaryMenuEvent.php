<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;

/**
 * Primary Menu Event
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class PrimaryMenuEvent extends Event
{
	/**
	 * @var MenuItem
	 */
	protected $menu;
	
	/**
	 * @var FactoryInterface
	 */
	protected $factory;
	
	/**
	 * @param MenuItem $menu
	 * @param FactoryInterface $factory
	 */
	public function __construct($menu, FactoryInterface $factory)
	{
		$this->menu = $menu;
		$this->factory = $factory;
	}
	
	/**
	 * @return MenuItem
	 */
	public function getMenu()
	{
		return $this->menu;
	}
	
	/**
	 * @return FactoryInterface
	 */
	public function getFactory()
	{
		return $this->factory;
	}
}