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

use ASF\WebsiteBundle\Event\WebsiteEvents;

/**
 * Website Events Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class WebsiteEventsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ASF\WebsiteBundle\Event\WebsiteEvents
     */
	public function testEventNames()
	{
	    $this->assertEquals('asf_website.menu.primary.init', WebsiteEvents::PRIMARY_MENU_INIT);
	}
}