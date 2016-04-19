<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use ASF\WebsiteBundle\Utils\Manager\DefaultManagerInterface;

/**
 * Transform an ID to an Group entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdToConfigTransformer implements DataTransformerInterface
{
	/**
	 * @var DefaultManagerInterface
	 */
	protected $configManager;
	
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @param DefaultManagerInterface $configManager
	 */
	public function __construct(DefaultManagerInterface $configManager)
	{
		$this->configManager = $configManager;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\DataTransformerInterface::transform()
	 */
	public function transform($config)
	{
		if ( is_null($config) )
			return '';
		
		return $config->getId();
	}

	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\DataTransformerInterface::reverseTransform()
	 */
	public function reverseTransform($id)
	{
		$config = $this->configManager->getRepository()->findOneBy(array('id' => $id));
		return $config;
	}
}