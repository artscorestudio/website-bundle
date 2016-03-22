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

use ASF\WebsiteBundle\Event\MenuSubscriber;
use ASF\WebsiteBundle\Event\PrimaryMenuEvent;
use Knp\Menu\MenuItem;
use Knp\Menu\MenuFactory;

/**
 * Website Menu Subscriber Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class MenuSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ASF\WebsiteBundle\Event\MenuSubscriber
     */
    protected $subscriber;
    
    /**
     * @var \ASF\WebsiteBundle\Event\PrimaryMenuEvent
     */
    protected $primaryEvent;
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        parent::setUp();
        
        // Navbar Event
        $factory = new MenuFactory();
        $menu = new MenuItem('root', $factory);
        $this->primaryEvent = new PrimaryMenuEvent($menu, $factory);
        
        // Menu Subscriber
        $request = $this->getMockBuilder('Symfony\Component\HttpFoundation\RequestStack')
            ->disableOriginalConstructor()->getMock();
        $translator = $this->getMockBuilder('Symfony\Component\Translation\Translator')->disableOriginalConstructor()->getMock();
        $this->subscriber = new MenuSubscriber($request, $translator);
    }
    
    /**
     * @covers ASF\WebsiteBundle\Event\MenuSubscriber
     * @covers ASF\WebsiteBundle\Event\MenuSubscriber::getSubscribedEvents
     */
    public function testGetSubscribedEventsMethod()
    {
        $this->assertCount(1, $this->subscriber->getSubscribedEvents());
    }
    
    /**
     * @covers ASF\WebsiteBundle\Event\MenuSubscriber::onPrimaryMenuInit
     */
    public function testOnPrimaryMenuInit()
    {
        $this->subscriber->onPrimaryMenuInit($this->primaryEvent);
        $this->assertTrue($this->primaryEvent->getMenu()->hasChildren());
    }
}