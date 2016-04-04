<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\QueryBuilder;

use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Source\Entity;
use ASF\WebsiteBundle\Form\Handler\GroupFormHandler;


/**
 * Website Config Controller
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class WebsiteConfigController extends Controller
{
	/**
	 * List all website config
	 *
	 * @throws AccessDeniedException If authenticate user is not allowed to access to this resource (minimum ROLE_ADMIN)
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function listAction()
	{
		if ( false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') )
			throw new AccessDeniedException();
	
		// Set Datagrid source
		$source = new Entity($this->get('asf_website.group_parameter.manager')->getClassName());
		$tableAlias = $source->getTableAlias();
		$source->manipulateQuery(function($query) use ($tableAlias){
			$query instanceof QueryBuilder;

			if ( count($query->getDQLPart('orderBy')) == 0) {
				$query->orderBy($tableAlias . '.name', 'ASC');
			}
		});

		// Get Grid instance
		$grid = $this->get('grid');
		$grid instanceof Grid;

		// Attach the source to the grid
		$grid->setSource($source);
		$grid->setId('asf_group_parameter_list');

		// Columns configuration
		$grid->hideColumns(array('id'));
	
		$grid->getColumn('name')->setTitle($this->get('translator')->trans('Parameter group name', array(), 'asf_website'))
			->setDefaultOperator('like')
			->setOperatorsVisible(false);

		$editAction = new RowAction('btn_edit', 'asf_website_config_edit');
		$editAction->setRouteParameters(array('id'));
		$grid->addRowAction($editAction);

		$deleteAction = new RowAction('btn_delete', 'asf_website_config_delete', true);
		$deleteAction->setRouteParameters(array('id'))
			->setConfirmMessage($this->get('translator')->trans('Do you want to delete this config ?', array(), 'asf_website'));
		$grid->addRowAction($deleteAction);
	
		$grid->setNoDataMessage($this->get('translator')->trans('No config were found.', array(), 'asf_website'));
	
		return $grid->getGridResponse('ASFWebsiteBundle:WebsiteConfig:list.html.twig');
	}
	
	/**
	 * Add or edit a website config
	 *
	 * @param Request $request
	 * @param integer $id           ASFWebsiteBundle:Group Entity ID
	 *
	 * @throws AccessDeniedException If authenticate user is not allowed to access to this resource (minimum ROLE_ADMIN)
	 * @throws \Exception            Error on group not found
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, $id = null)
	{
		if ( false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') )
			throw new AccessDeniedException();
		  
		$formFactory = $this->get('asf_website.form.factory.group_parameter');
		$groupManager = $this->get('asf_website.group_parameter.manager');
		  
		if ( !is_null($id) ) {
			$group = $groupManager->getRepository()->findOneBy(array('id' => $id));
			$success_message = $this->get('translator')->trans('Updated successfully', array(), 'asf_website');
				
		} else {
			$group = $groupManager->createInstance();
			$group->setName($this->get('translator')->trans('New group', array(), 'asf_website'));
			$success_message = $this->get('translator')->trans('Created successfully', array(), 'asf_website');
		}
	
		if ( is_null($group) )
			throw new \Exception($this->get('translator')->trans('An error occurs when generating or getting the configuration', array(), 'asf_website'));

		$form = $formFactory->createForm();
		$form->setData($group);
		
		$formHandler = new GroupFormHandler($form, $request, $this->container);
		
		if ( true === $formHandler->process() ) {
			
			try {
				
				if ( is_null($group->getId()) ) {
					$groupManager->getEntityManager()->persist($group);
				}
				$groupManager->getEntityManager()->flush();
				 
				if ( $this->has('asf_layout.flash_message') ) {
					$this->get('asf_layout.flash_message')->success($success_message);
				}

				return $this->redirect($this->get('router')->generate('asf_website_config_edit', array('id' => $group->getId())));

			} catch(\Exception $e) {
				if ( $this->has('asf_layout.flash_message') ) {
					$this->get('asf_layout.flash_message')->danger($e->getMessage());
				}
			}
		}

		return $this->render('ASFWebsiteBundle:WebsiteConfig:edit.html.twig', array(
			'group' => $group,
			'form' => $form->createView()
		));
	}
	
	/**
	 * Delete a group
	 *
	 * @param  integer $id           ASFWebsiteBundle:Group Entity ID
	 * @throws AccessDeniedException If authenticate user is not allowed to access to this resource (minimum ROLE_ADMIN)
	 * @throws \Exception            Error on group not found or on removing element from DB
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction($id)
	{
		if ( false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') )
			throw new AccessDeniedException();
		  
		$group = $this->get('asf_website.group.manager')->getRepository()->findOneBy(array('id' => $id));

		try {
			$this->get('asf_website.group.manager')->getEntityManager()->remove($group);
			$this->get('asf_website.group.manager')->getEntityManager()->flush();
			
			if ( $this->has('asf_layout.flash_message') ) {
				$this->get('asf_layout.flash_message')->success($this->get('translator')->trans('The group "%name%" successfully deleted.', array('%name%' => $group->getName()), 'asf_website'));
			}
				
		} catch (\Exception $e) {
			if ( $this->has('asf_layout.flash_message') ) {
				$this->get('asf_layout.flash_message')->danger($e->getMessage());
			}
		}

		return $this->redirect($this->get('router')->generate('asf_website_config_list'));
	}
}