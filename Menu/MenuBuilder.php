<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use ASF\WebsiteBundle\Event\WebsiteEvents;
use ASF\WebsiteBundle\Event\PrimaryMenuEvent;
use Symfony\Component\HttpFoundation\RequestStack;

use Knp\Menu\ItemInterface;
use Knp\Menu\MenuItem;

/**
 * Knp Menu Builder
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class MenuBuilder
{
	/**
	 * @var FactoryInterface
	 */
	protected $factory;
	
	/**
	 * @var EventDispatcher
	 */
	protected $eventDispatcher;
	
	/**
	 * @var RequestStack
	 */
	protected $request;
	
	/**
	 * @param FactoryInterface         $factory
	 * @param EventDispatcherInterface $event_dispatcher
	 * @param RequestStack             $request
	 */
	public function __construct(FactoryInterface $factory, EventDispatcherInterface $event_dispatcher, $request)
	{
		$this->factory = $factory;
		$this->eventDispatcher = $event_dispatcher;
		$this->request = $request;
	}
	
	/**
	 * Navbar Menu
	 * 
	 * @param array $options
	 * @return ItemInterface
	 */
	public function createPrimaryMenu(array $options)
	{
		$menu = $this->factory->createItem('root');
		
		$this->eventDispatcher->dispatch(WebsiteEvents::PRIMARY_MENU_INIT, new PrimaryMenuEvent($menu, $this->factory));
		
		$this->reorderMenuItems($menu);
		
		return $menu;
	}

	/**
	 * Reorder Menus items
	 * 
	 * @param ItemInterface $menu
	 */
	protected function reorderMenuItems(ItemInterface $menu)
	{
		$menuOrderArray = array();
		$addLast = array();
		$alreadyTaken = array();
		
		foreach ($menu->getChildren() as $key => $menuItem) {
		
			if ($menuItem->hasChildren()) {
				$this->reorderMenuItems($menuItem);
			}
		
			$orderNumber = $menuItem->getExtra('orderNumber');
		
			if ($orderNumber != null) {
				if (!isset($menuOrderArray[$orderNumber])) {
					$menuOrderArray[$orderNumber] = $menuItem->getName();
				} else {
					$alreadyTaken[$orderNumber] = $menuItem->getName();
					// $alreadyTaken[] = array('orderNumber' => $orderNumber, 'name' => $menuItem->getName());
				}
			} else {
				$addLast[] = $menuItem->getName();
			}
		}
		
		// sort them after first pass
		ksort($menuOrderArray);
		
		// handle position duplicates
		if (count($alreadyTaken)) {
			foreach ($alreadyTaken as $key => $value) {
				// the ever shifting target
				$keysArray = array_keys($menuOrderArray);
		
				$position = array_search($key, $keysArray);
		
				if ($position === false) {
					continue;
				}
		
				$menuOrderArray = array_merge(array_slice($menuOrderArray, 0, $position), array($value), array_slice($menuOrderArray, $position));
			}
		}
		
		// sort them after second pass
		ksort($menuOrderArray);
		
		// add items without ordernumber to the end
		if (count($addLast)) {
			foreach ($addLast as $key => $value) {
				$menuOrderArray[] = $value;
			}
		}
		
		if (count($menuOrderArray)) {
			$menu->reorderChildren($menuOrderArray);
		}
	}
}