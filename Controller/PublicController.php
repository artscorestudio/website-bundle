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

/**
 * Default Controller gather generic app views
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class PublicController extends Controller
{
    /**
     * Website Homepage
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('ASFWebsiteBundle:Public:index.html.twig');
    }
    
    public function pageAction($path)
    {
    	$parts = explode('/', $path);
    	
    	$result = $this->get('asf_document.page.manager')->getRepository()->findBySlug($path);
    	
    	if ( count($result) == 0 ) {
    		throw new \Exception('Unable to find the page.');
    	}
    	
    	$page = $result[0];
    	
    	return $this->render('ASFWebsiteBundle:Public:page.html.twig', array(
    		'page' => $page
    	));
    }
}