<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Website Config Repository
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ConfigRepository extends EntityRepository
{
	/**
	 * Get Default Configuration
	 * 
	 */
	public function getDefaultConfiguration()
	{
		$query = $this->createQueryBuilder('c');
		$query->where('c.isDefault=:isDefault')
			->orderBy('c.updatedAt', 'DESC')
			->setMaxResults(1)
			->setParameter(':isDefault', true);
		
		return $query->getQuery()->getResult();
	}
}