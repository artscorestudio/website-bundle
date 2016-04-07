<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Public Controller Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class PublicControllerTest extends WebTestCase
{
	/**
	 * @var Client
	 */
	private $client;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		$this->client = static::createClient();
	}
	
    /**
     * @covers ASF\WebsiteBundle\Controller\PublicController::indexAction
     */
    public function testIndexAction()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Default Website template")')->count());
    }
    
    /**
     * @covers ASF\WebsiteBundle\Controller\PublicController::pageAction
     */
    public function testPageActionNotFoundException()
    {
    	$this->setExpectedException('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
    	$crawler = $this->client->request('/maPage');
    }
}