<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Tests\Entity\Manager;

use Doctrine\ORM\EntityManager;
use ASF\WebsiteBundle\Entity\Manager\ASFWebsiteEntityManager;
use ASF\WebsiteBundle\Entity\Config;

/**
 * Base class for Artscore Studio Framework Entity Managers
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFWebsiteEntityManagerTest extends \PHPUnit_Framework_TestCase
{
	const CONFIG_CLASS = 'ASF\WebsiteBundle\Tests\EntityManager\DummyConfig';
	
    /**
     * @var \ASF\WebsiteBundle\Entity\Manager\ASFWebsiteEntityManagerInterface
     */
    protected $configManager;
    
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $em;
    
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $repository;
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        parent::setUp();
        
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
        	$this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->em = $this->getMock('Doctrine\ORM\EntityManagerInterface');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        
        $this->repository->expects($this->any())
        	->method('getClassName')
        	->will($this->returnValue(static::CONFIG_CLASS));
        
        $this->em->expects($this->any())
	        ->method('getRepository')
	        ->will($this->returnValue($this->repository));
        
        $this->em->expects($this->any())
	        ->method('getClassMetadata')
	        ->with($this->equalTo(static::CONFIG_CLASS))
	        ->will($this->returnValue($class));
        
        $class->expects($this->any())
	        ->method('getName')
	        ->will($this->returnValue(static::CONFIG_CLASS));
        
        $this->configManager = $this->createConfigManager($this->em, static::CONFIG_CLASS);
    }
    
    /**
     * @covers ASF\WebsiteBundle\Entity\Manager\ASFWebsiteEntityManager
     */
    public function testWebsiteEntityManager()
    {
        $this->assertEquals(static::CONFIG_CLASS, $this->configManager->getClassName());
    }
    
    /**
     * Get Config Entity Manager
     * 
     * @param \PHPUnit_Framework_MockObject_MockObject $entity_manager
     * @param string                                   $entity_name
     * 
     * @return \ASF\WebsiteBundle\Entity\Manager\ASFWebsiteEntityManager
     */
    protected function createConfigManager($entity_manager, $entity_name)
    {
    	return new ASFWebsiteEntityManager($entity_manager, $entity_name);
    }
}

/**
 * Dummy Config class for tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class DummyConfig extends Config {}