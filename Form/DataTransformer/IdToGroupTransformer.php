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
use ASF\WebsiteBundle\Entity\Manager\ASFWebsiteEntityManagerInterface;

/**
 * Transform an ID to an Group entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdToGroupTransformer implements DataTransformerInterface
{
	/**
	 * @var ASFWebsiteEntityManagerInterface
	 */
	protected $groupManager;
	
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @param ASFWebsiteEntityManagerInterface $groupManager
	 */
	public function __construct(ASFWebsiteEntityManagerInterface $groupManager)
	{
		$this->groupManager = $groupManager;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\DataTransformerInterface::transform()
	 */
	public function transform($group)
	{
		if ( is_null($group) )
			return '';
		
		return $group->getId();
	}

	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\DataTransformerInterface::reverseTransform()
	 */
	public function reverseTransform($id)
	{
		$group = $this->groupManager->getRepository()->findOneBy(array('id' => $id));
		return $group;
	}
}