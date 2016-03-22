<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Tests\Event;

use ASF\WebsiteBundle\Event\PrimaryMenuEvent;
use Knp\Menu\MenuItem;
use Knp\Menu\MenuFactory;

/**
 * Primary Menu Event Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class PrimaryMenuEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PrimaryMenuEvent
     */
    protected $event;
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        parent::setUp();
        
        $factory = new MenuFactory();
        $menu = new MenuItem('root', $factory);
        
        $this->event = new PrimaryMenuEvent($menu, $factory);
    }
    
    /**
     * @covers ASF\WebsiteBundle\Event\PrimaryMenuEvent
     * @covers ASF\WebsiteBundle\Event\PrimaryMenuEvent::getMenu
     */
	public function testGetMenuMethod()
	{
	    $this->assertInstanceOf('Knp\Menu\MenuItem', $this->event->getMenu());
	}
	
	/**
	 * @covers ASF\WebsiteBundle\Event\PrimaryMenuEvent::getFactory
	 */
	public function testGetFactoryMethod()
	{
	    $this->assertInstanceOf('Knp\Menu\FactoryInterface', $this->event->getFactory());
	}
}