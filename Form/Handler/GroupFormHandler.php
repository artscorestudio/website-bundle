<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Form\Handler;

use ASF\CoreBundle\Form\Handler\FormHandlerModel;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use ASF\WebsiteBundle\Model\Config\Group;

/**
 * Group Form Handler
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class GroupFormHandler extends FormHandlerModel
{
	/**
	 * @var ContainerInterface
	 */
	protected $container;
	
	/**
	 * @param FormInterface      $form
	 * @param ContainerInterface $container
	 */
	public function __construct(FormInterface $form, Request $request, ContainerInterface $container)
	{
		parent::__construct($form, $request);
		$this->container = $container;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Asf\ApplicationBundle\Application\Form\FormHandlerModel::processForm()
	 * @throw \Exception
	 */
	public function processForm($model)
	{
		try {
			$model instanceof Group;
			foreach($model->getParameters() as $parameter ) {
				$parameter->setGroup($model);
			}
			
			$db_parameters = $this->container->get('asf_website.parameter.manager')->getRepository()->findBy(array('group' => $model));
			foreach($db_parameters as $db_parameter) {
				if ( !$model->getParameters()->contains($db_parameter) ) {
					$model->removeParameter($db_parameter);
					$this->container->get('asf_website.parameter.manager')->getEntityManager()->remove($db_parameter);
				}
			}
			
			return true;
			
		} catch (\Exception $e) {
			throw new \Exception(sprintf('An error occured : %s', $e->getMessage()));
		}
		
		return false;
	}
}