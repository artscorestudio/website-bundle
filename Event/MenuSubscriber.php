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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\RouteVoter;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Website Menu Subscriber
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class MenuSubscriber implements EventSubscriberInterface
{
	/**
	 * @var RequestStack
	 */
	protected $request;
	
	/**
	 * @var TranslatorInterface
	 */
	protected $translator;
	
	/**
	 * @param RequestStack $request
	 */
	public function __construct(RequestStack $request, $translator)
	{
		$this->request = $request;
		$this->translator = $translator;
	}
	
	/**
	 * Subscribed Events
	 */
	public static function getSubscribedEvents()
	{
		return array(
			 WebsiteEvents::PRIMARY_MENU_INIT => array('onPrimaryMenuInit', 0)
		);
	}

	/**
	 * @param PrimaryMenuEvent $event
	 */
	public function onPrimaryMenuInit(PrimaryMenuEvent $event)
	{
		$menu = $event->getMenu();
		$factory = $event->getFactory();
		
		$matcher = new Matcher();
		$matcher->addVoter(new RouteVoter($this->request->getCurrentRequest()));
		
		// Home link
		$item = $factory->createItem($this->translator->trans('Home', array(), 'asf_website'), array('route' => 'asf_website_homepage'));
		$menu->addChild($item);
		
		$item->setCurrent($matcher->isCurrent($item));
	}
}