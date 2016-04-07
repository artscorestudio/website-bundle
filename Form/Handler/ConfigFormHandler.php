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
use ASF\WebsiteBundle\Model\Config\Config;

/**
 * Group Form Handler
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ConfigFormHandler extends FormHandlerModel
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
			$configManager = $this->container->get('asf_website.config.manager');
			
			// Check configuration alias (internal use)
			$isExists = $configManager->getRepository()->findOneBy(array('alias' => $model->getAlias()));
			if ( $isExists !== null ) {
				throw new \Exception($this->container->get('asf_layout.flash_message')->danger($this->container->get('translator')->trans('A website configuration already exists with alias "%name%".', array('%name%' => $model->getAlias()), 'asf_website')));
			}
			
			// Check default configuration
			$defaultExists = $configManager->getRepository()->findOneBy(array('isDefault' => true));
			if ( $defaultExists === null ) {
				$model->setIsDefault(true);
			} elseif ($model->getIsDefault() == true && $model->getId() != $defaultExists->getId() ) {
				throw new \Exception($this->container->get('asf_layout.flash_message')->danger($this->container->get('translator')->trans('A default website configuration already exists ("%name%").', array('%name%' => $defaultExists->getName()), 'asf_website')));
			}
			
			$model instanceof Config;
			foreach($model->getParameters() as $parameter ) {
				$parameter->setConfig($model);
			}
			
			$db_parameters = $this->container->get('asf_website.parameter.manager')->getRepository()->findBy(array('config' => $model));
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